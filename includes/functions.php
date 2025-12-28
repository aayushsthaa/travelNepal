<?php
// travelNepal Utility Functions



/**
 * Database connection is defined in config.php
 * This comment is kept as a reference
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function renderHtml($html) {
    $allowed = '<p><br><strong><b><em><i><u><a><ul><ol><li><h1><h2><h3><h4><h5><h6><img><blockquote><code><pre><span><div>'; 
    $html = strip_tags($html, $allowed);
    $html = preg_replace('/on\w+\s*=\s*"[^"]*"/i', '', $html);
    $html = preg_replace("/on\w+\s*=\s*'[^']*'/i", '', $html);
    $html = preg_replace('/on\w+\s*=\s*[^\s>]+/i', '', $html);
    $html = preg_replace('/(href|src)\s*=\s*"(javascript:|data:)[^"]*"/i', '$1="#"', $html);
    $html = preg_replace("/(href|src)\s*=\s*'(javascript:|data:)[^']*'/i", '$1="#"', $html);
    $html = preg_replace('/<(script|style|iframe|object|embed)[^>]*>[\s\S]*?<\/\1>/i', '', $html);
    return $html;
}

function isValidSlug($slug) {
    return is_string($slug) && preg_match('/^[a-z0-9-]+$/', $slug);
}

/**
 * Authenticate user against database
 */
function authenticateUser($username, $password) {
    $db = getDbConnection();
    if (!$db) {
        return false;
    }
    
    $stmt = $db->prepare("SELECT id, username, password_hash, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['admin_logged_in'] = ($user['role'] === 'admin');
        return true;
    }
    
    return false;
}

/**
 * Check if user is logged in as admin
 */
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Change user password
 */
function changePassword($current_password, $new_password) {
    if (!isLoggedIn()) {
        return "You must be logged in to change your password";
    }
    
    $db = getDbConnection();
    if (!$db) {
        return "Database connection error";
    }
    
    // Get current user
    $userId = $_SESSION['user_id'];
    $stmt = $db->prepare("SELECT password_hash FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    
    if (!$user) {
        return "User not found";
    }
    
    // Verify current password
    if (!password_verify($current_password, $user['password_hash'])) {
        return "Current password is incorrect";
    }
    
    // Update with new password
    $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $result = $stmt->execute([$passwordHash, $userId]);
    
    if ($result) {
        return true;
    } else {
        return "Failed to update password";
    }
}

/**
 * Redirect to login if not authenticated
 */
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: ' . siteUrl('admin/login'));
        exit();
    }
}

/**
 * Generate a unique slug from title
 */
function generateSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text . '-' . time();
}

/**
 * Format date for display
 */
function formatDate($timestamp) {
    return date('F j, Y', $timestamp);
}

/**
 * Truncate text for excerpts
 */
function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

/**
 * Load blog posts from database
 */
function loadBlogPosts($limit = null, $includeUnpublished = false) {
    $pdo = getDbConnection();
    
    // Use database if available
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, title, slug, excerpt, content, category, tags, featured_image, published, 
                           UNIX_TIMESTAMP(created_at) as created_at, 
                           UNIX_TIMESTAMP(updated_at) as updated_at 
                    FROM posts";
            
            if (!$includeUnpublished) {
                $sql .= " WHERE published = 1";
            }
            
            $sql .= " ORDER BY created_at DESC";
            
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->query($sql);
            $posts = $stmt->fetchAll();
            
            // Convert JSON tags back to array and timestamps to integers
            foreach ($posts as &$post) {
                $post['tags'] = !empty($post['tags']) ? json_decode($post['tags'], true) ?: [] : [];
                $post['created_at'] = (int)$post['created_at'];
                $post['updated_at'] = (int)$post['updated_at'];
                $post['published'] = (bool)$post['published'];
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
            // Use JSON fallback
        }
    }
    
    // JSON fallback
    $dataPath = DATA_PATH . '/posts';
    if (!is_dir($dataPath)) {
        return [];
    }
    
    $posts = [];
    $files = array_diff(scandir($dataPath), ['.', '..']);
    
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
            $content = file_get_contents($dataPath . '/' . $file);
            $post = json_decode($content, true);
            if ($post && ($includeUnpublished || $post['published'])) {
                $posts[] = $post;
            }
        }
    }
    
    // Sort by creation date (newest first)
    usort($posts, function($a, $b) {
        return $b['created_at'] - $a['created_at'];
    });
    
    return $limit ? array_slice($posts, 0, $limit) : $posts;
}

/**
 * Load a single blog post by slug
 */
function loadBlogPost($slug) {
    if (!isValidSlug($slug)) {
        return null;
    }
    $pdo = getDbConnection();
    
    // Use database if available
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, title, slug, excerpt, content, category, tags, featured_image, published, 
                           UNIX_TIMESTAMP(created_at) as created_at, 
                           UNIX_TIMESTAMP(updated_at) as updated_at 
                    FROM posts WHERE slug = ?";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$slug]);
            $post = $stmt->fetch();
            
            if ($post) {
                // Convert JSON tags back to array and timestamps to integers
                $post['tags'] = !empty($post['tags']) ? json_decode($post['tags'], true) ?: [] : [];
                $post['created_at'] = (int)$post['created_at'];
                $post['updated_at'] = (int)$post['updated_at'];
                $post['published'] = (bool)$post['published'];
            }
            
            return $post ?: null;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
            // Use JSON fallback
        }
    }
    
    // JSON fallback
    if (!isValidSlug($slug)) {
        return null;
    }
    $filePath = DATA_PATH . "/posts/{$slug}.json";
    if (!file_exists($filePath)) {
        return null;
    }
    
    $content = file_get_contents($filePath);
    return json_decode($content, true);
}

/**
 * Save blog post to database
 */
function saveBlogPost($data) {
    $pdo = getDbConnection();
    
    // Use database if available
    if ($pdo !== null) {
        try {
            // Start transaction for data integrity
            $pdo->beginTransaction();
            
            // Check if this is an update (post exists) or insert (new post)
            $existingPost = loadBlogPost($data['slug']);
            
            // Prepare data for database insertion
            $tags_json = json_encode($data['tags']);
            $published = $data['published'] ? 1 : 0;
            
            if ($existingPost) {
                // Update existing post
                $sql = "UPDATE posts SET 
                            title = ?,
                            excerpt = ?,
                            content = ?,
                            category = ?,
                            tags = ?,
                            featured_image = ?,
                            published = ?,
                            updated_at = NOW()
                        WHERE slug = ?";
                        
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                    $data['title'],
                    $data['excerpt'], 
                    $data['content'],
                    $data['category'] ?? '',
                    $tags_json,
                    $data['featured_image'] ?? '',
                    $published,
                    $data['slug']
                ]);
            } else {
                // Insert new post
                $sql = "INSERT INTO posts (title, slug, excerpt, content, category, tags, featured_image, published, author_id, created_at, updated_at)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
                        
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([
                    $data['title'],
                    $data['slug'],
                    $data['excerpt'],
                    $data['content'], 
                    $data['category'] ?? '',
                    $tags_json,
                    $data['featured_image'] ?? '',
                    $published,
                    $_SESSION['user_id'] ?? 1
                ]);
            }
            
            if ($result) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
                return false;
            }
        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log('Database save error: ' . $e->getMessage());
            // Use JSON fallback
        }
    }
    
    // JSON fallback
    $dataPath = DATA_PATH . '/posts';
    if (!is_dir($dataPath)) {
        mkdir($dataPath, 0755, true);
    }
    
    $filePath = $dataPath . '/' . $data['slug'] . '.json';
    return file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}

/**
 * Delete blog post
 */
function deleteBlogPost($slug) {
    if (!isValidSlug($slug)) {
        return false;
    }
    $pdo = getDbConnection();
    
    // Use database if available
    if ($pdo !== null) {
        try {
            // Start transaction for data integrity
            $pdo->beginTransaction();
            
            // Get post ID first for image cleanup
            $stmt = $pdo->prepare("SELECT id, featured_image FROM posts WHERE slug = ?");
            $stmt->execute([$slug]);
            $post = $stmt->fetch();
            
            if (!$post) {
                $pdo->rollBack();
                return false;
            }
            
            $postId = $post['id'];
            
            // Delete featured image file if exists
            if (!empty($post['featured_image'])) {
                $featuredImagePath = BASE_PATH . $post['featured_image'];
                if (file_exists($featuredImagePath)) {
                    unlink($featuredImagePath);
                }
            }
            
            // Delete all gallery images (this will clean up files too)
            deletePostImages($postId);
            
            // Delete the post (CASCADE will handle post_images records)
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$postId]);
            
            if ($result) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
                return false;
            }
        } catch (Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            error_log('Database delete error: ' . $e->getMessage());
            return false;
        }
    }
    
    // Fallback to JSON file method
    if (!isValidSlug($slug)) {
        return false;
    }
    $filePath = DATA_PATH . "/posts/{$slug}.json";
    if (file_exists($filePath)) {
        return unlink($filePath);
    }
    return false;
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Require valid CSRF token or die
 */
function requireCSRF() {
    $token = $_POST['csrf_token'] ?? '';
    if (!verifyCSRFToken($token)) {
        http_response_code(403);
        die('CSRF token verification failed');
    }
}

/**
 * Include template with variables
 */
function includeTemplate($template, $variables = []) {
    if (!defined('TEMPLATES_PATH')) {
        define('TEMPLATES_PATH', dirname(__DIR__) . '/templates');
    }
    
    if (!defined('SITE_URL')) {
        define('SITE_URL', 'http://localhost/travelNepal');
    }
    
    $template_file = TEMPLATES_PATH . '/' . $template . '.php';
    
    // Check if template file exists
    if (!file_exists($template_file)) {
        error_log("Template file not found: $template_file");
        echo "Error: Template '$template' not found.";
        return;
    }
    
    // Extract variables for template
    extract($variables);
    
    // Include the template file
    include $template_file;
}


/**
 * Helper function to ensure all image paths use SITE_URL
 */
function ensureFullImageUrl($path) {
    if (empty($path)) return '';
    
    // If already a full URL, return as is
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    
    // If already has SITE_URL, return as is
    if (strpos($path, SITE_URL) === 0) {
        return $path;
    }
    
    // If starts with /, append to SITE_URL
    if (strpos($path, '/') === 0) {
        return SITE_URL . $path;
    }
    
    // Otherwise, append to SITE_URL with /
    return SITE_URL . '/' . $path;
}

/**
 * Get all categories from database
 */
function getCategories() {
    $pdo = getDbConnection();
    
    // Use database if available
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, name, slug FROM categories ORDER BY name";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log('Database categories error: ' . $e->getMessage());
            // Use default categories
        }
    }
    
    // Fallback to default categories
    return [
        ['id' => 1, 'name' => 'Trekking', 'slug' => 'trekking'],
        ['id' => 2, 'name' => 'Culture', 'slug' => 'culture'],
        ['id' => 3, 'name' => 'Adventure', 'slug' => 'adventure'],
        ['id' => 4, 'name' => 'Photography', 'slug' => 'photography'],
        ['id' => 5, 'name' => 'Food', 'slug' => 'food']
    ];
}

/**
 * Load all blog posts including unpublished (for admin)
 */
function loadAllBlogPosts($limit = null) {
    return loadBlogPosts($limit, true);
}

/**
 * Create a new category
 */
function createCategory($name, $slug = null) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        // Generate slug if not provided
        if ($slug === null) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($name)));
            $slug = trim($slug, '-');
        }
        
        $sql = "INSERT INTO categories (name, slug, created_at) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $slug]);
        return $pdo->lastInsertId();
    } catch (Exception $e) {
        error_log('Database category creation error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Update an existing category
 */
function updateCategory($id, $name, $slug) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        $sql = "UPDATE categories SET name = ?, slug = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $slug, $id]);
        return true;
    } catch (Exception $e) {
        error_log('Database category update error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete a category
 */
function deleteCategory($id) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        // Get the category name first
        $categorySql = "SELECT name FROM categories WHERE id = ?";
        $categoryStmt = $pdo->prepare($categorySql);
        $categoryStmt->execute([$id]);
        $category = $categoryStmt->fetch();
        
        if (!$category) {
            return ['success' => false, 'error' => 'Category not found'];
        }
        
        $categoryName = $category['name'];
        
        // Check if category is in use by posts
        $checkSql = "SELECT COUNT(*) FROM posts WHERE category = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$categoryName]);
        $postCount = $checkStmt->fetchColumn();
        
        if ($postCount > 0) {
            // Category is in use, cannot delete
            return ['success' => false, 'error' => 'Cannot delete category: it is being used by ' . $postCount . ' post(s)'];
        }
        
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return ['success' => true];
    } catch (Exception $e) {
        error_log('Database category deletion error: ' . $e->getMessage());
        return ['success' => false, 'error' => 'Database error occurred'];
    }
}



/**
 * Generate secure random filename for uploads
 */
function generateSecureFilename($originalName) {
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $randomName = bin2hex(random_bytes(16));
    return $randomName . '.' . $extension;
}

/**
 * Validate uploaded file security and constraints
 */
function validateUploadedFile($file) {
    $errors = [];
    
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return ['No file uploaded'];
    }
    
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['File upload error: ' . $file['error']];
    }
    
    // Check file size
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        $maxSizeMB = MAX_UPLOAD_SIZE / (1024 * 1024);
        return ["File too large. Maximum size: {$maxSizeMB}MB"];
    }
    
    // Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, ALLOWED_IMAGE_TYPES)) {
        return ['Invalid file type. Only JPEG, PNG, and WebP images are allowed.'];
    }
    
    // Check file extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        return ['Invalid file extension. Only jpg, jpeg, png, and webp files are allowed.'];
    }
    
    // Additional security: check file signature (magic bytes)
    $handle = fopen($file['tmp_name'], 'rb');
    $signature = fread($handle, 8);
    fclose($handle);
    
    $validSignatures = [
        "\xFF\xD8\xFF", // JPEG
        "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A", // PNG
        "RIFF", // WebP (RIFF header)
    ];
    
    $isValidSignature = false;
    foreach ($validSignatures as $validSig) {
        if (strpos($signature, $validSig) === 0) {
            $isValidSignature = true;
            break;
        }
    }
    
    if (!$isValidSignature) {
        return ['Invalid file format. File appears to be corrupted or not a valid image.'];
    }
    
    // Check for PHP code in image files (additional security)
    $content = file_get_contents($file['tmp_name']);
    if (strpos($content, '<?php') !== false || strpos($content, '<?=') !== false || 
        strpos($content, '<script') !== false || strpos($content, '<html') !== false) {
        return ['Security violation: File contains potentially malicious content.'];
    }
    
    return []; // No errors
}

/**
 * Create upload directory for year/month structure
 */
function createUploadDirectory() {
    $year = date('Y');
    $month = date('m');
    $uploadDir = UPLOADS_PATH . "/{$year}/{$month}";
    
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            return false;
        }
    }
    
    return $uploadDir;
}

/**
 * Handle secure file upload
 */
function handleFileUpload($file) {
    // Validate file
    $errors = validateUploadedFile($file);
    if (!empty($errors)) {
        return ['success' => false, 'error' => implode(' ', $errors)];
    }
    
    // Create upload directory
    $uploadDir = createUploadDirectory();
    if (!$uploadDir) {
        return ['success' => false, 'error' => 'Failed to create upload directory'];
    }
    
    // Generate secure filename
    $secureFilename = generateSecureFilename($file['name']);
    $targetPath = $uploadDir . '/' . $secureFilename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => false, 'error' => 'Failed to move uploaded file'];
    }
    
    // Set proper permissions
    chmod($targetPath, 0644);
    
    // Generate public URL
    $year = date('Y');
    $month = date('m');
    $publicUrl = "/uploads/{$year}/{$month}/{$secureFilename}";
    
    return [
        'success' => true,
        'url' => $publicUrl,
        'filename' => $secureFilename,
        'path' => $targetPath
    ];
}

/**
 * Sanitize and prevent directory traversal
 */
function sanitizeFilePath($path) {
    // Remove any directory traversal attempts (multiple passes to handle complex attacks)
    $path = str_replace(['../', '..\/', '..\\', '...', '..', './', '.\/', '.\\'], '', $path);
    $path = str_replace(['../', '..\/', '..\\', '...', '..', './', '.\/', '.\\'], '', $path); // Second pass
    
    // Only allow alphanumeric characters, dots, hyphens, and underscores (no slashes)
    $path = preg_replace('/[^a-zA-Z0-9._\-]/', '', $path);
    
    if (empty($path) || strpos($path, '..') !== false || strpos($path, './') !== false) {
        return 'invalid';
    }
    
    return $path;
}



/**
 * Load images for a specific post
 */
function loadPostImages($postId) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return [];
    }
    
    try {
        $sql = "SELECT id, image_url, alt_text, sort_order 
                FROM post_images 
                WHERE post_id = ? 
                ORDER BY sort_order ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$postId]);
        $images = $stmt->fetchAll();
        
        // No timestamp conversion needed as created_at column was removed
        
        return $images;
    } catch (Exception $e) {
        error_log('Failed to load post images: ' . $e->getMessage());
        return [];
    }
}

/**
 * Save multiple images for a post
 */
function savePostImages($postId, $images) {
    $pdo = getDbConnection();
    
    if ($pdo === null || empty($images)) {
        return false;
    }
    
    try {
        $sql = "INSERT INTO post_images (post_id, image_url, alt_text, sort_order) 
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        foreach ($images as $index => $image) {
            $stmt->execute([
                $postId,
                $image['url'],
                $image['alt_text'] ?? '',
                $index + 1
            ]);
        }
        
        return true;
    } catch (Exception $e) {
        error_log('Failed to save post images: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete all images for a post
 */
function deletePostImages($postId) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        // Get image URLs before deleting to clean up files
        $images = loadPostImages($postId);
        
        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM post_images WHERE post_id = ?");
        $result = $stmt->execute([$postId]);
        
        // Clean up image files
        if ($result) {
            foreach ($images as $image) {
                $filePath = BASE_PATH . $image['image_url'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        
        return $result;
    } catch (Exception $e) {
        error_log('Failed to delete post images: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete a specific image
 */
function deletePostImage($imageId) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        // Get image details before deleting
        $stmt = $pdo->prepare("SELECT image_url FROM post_images WHERE id = ?");
        $stmt->execute([$imageId]);
        $image = $stmt->fetch();
        
        if (!$image) {
            return false;
        }
        
        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM post_images WHERE id = ?");
        $result = $stmt->execute([$imageId]);
        
        // Clean up file
        if ($result) {
            $filePath = BASE_PATH . $image['image_url'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        return $result;
    } catch (Exception $e) {
        error_log('Failed to delete post image: ' . $e->getMessage());
        return false;
    }
}

/**
 * Handle multiple file uploads
 */
function handleMultipleFileUploads($files) {
    if (empty($files['name'][0])) {
        return ['success' => true, 'images' => []]; // No files uploaded is okay
    }
    
    $uploadedImages = [];
    $errors = [];
    
    // Process each uploaded file
    for ($i = 0; $i < count($files['name']); $i++) {
        // Skip empty file slots
        if (empty($files['name'][$i])) {
            continue;
        }
        
        // Create individual file array for handleFileUpload
        $file = [
            'name' => $files['name'][$i],
            'type' => $files['type'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
            'size' => $files['size'][$i]
        ];
        
        $result = handleFileUpload($file);
        
        if ($result['success']) {
            $uploadedImages[] = [
                'url' => $result['url'],
                'filename' => $result['filename'],
                'alt_text' => ''  // Can be filled later
            ];
        } else {
            $errors[] = "Error uploading {$files['name'][$i]}: " . $result['error'];
        }
    }
    
    if (!empty($errors) && empty($uploadedImages)) {
        return ['success' => false, 'error' => implode('; ', $errors)];
    }
    
    return [
        'success' => true, 
        'images' => $uploadedImages,
        'partial_errors' => $errors
    ];
}

/**
 * Get post ID from slug
 */
function getPostIdFromSlug($slug) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return null;
    }
    
    try {
        $stmt = $pdo->prepare("SELECT id FROM posts WHERE slug = ?");
        $stmt->execute([$slug]);
        $result = $stmt->fetch();
        
        return $result ? $result['id'] : null;
    } catch (Exception $e) {
        error_log('Failed to get post ID: ' . $e->getMessage());
        return null;
    }
}

/**
 * Update admin password in runtime session file
 * Since we can't modify environment variables at runtime, we'll use a file-based approach
 */
 

/**
 * Get current admin password (check runtime file first, then environment)
 */
 

/**
 * Get current admin username (check runtime file first, then environment)
 */

/**
 * Calculate estimated read time for blog post content
 */
function calculateReadTime($content, $wordsPerMinute = 200) {
    // Strip HTML tags and get plain text
    $plainText = strip_tags($content);

    // Count words
    $wordCount = str_word_count($plainText);

    // Calculate minutes (round up to nearest minute, minimum 1 minute)
    $minutes = max(1, ceil($wordCount / $wordsPerMinute));

    // Return formatted string
    return $minutes . ' min read';
}

?>
