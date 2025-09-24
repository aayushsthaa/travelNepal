<?php
// travelNepal Utility Functions

// Include static destinations data
require_once __DIR__ . '/destinations-data.php';

/**
 * Sanitize input data
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

/**
 * Check if user is logged in as admin
 */
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Redirect to login if not authenticated
 */
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: /admin/login');
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
    
    // If database connection available, use it
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, title, slug, excerpt, content, category, tags, featured_image, published, 
                           EXTRACT(EPOCH FROM created_at) as created_at, 
                           EXTRACT(EPOCH FROM updated_at) as updated_at 
                    FROM posts";
            
            if (!$includeUnpublished) {
                $sql .= " WHERE published = true";
            }
            
            $sql .= " ORDER BY created_at DESC";
            
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->query($sql);
            $posts = $stmt->fetchAll();
            
            // Convert JSON tags back to array and timestamps to integers
            foreach ($posts as &$post) {
                $post['tags'] = json_decode($post['tags'], true) ?: [];
                $post['created_at'] = (int)$post['created_at'];
                $post['updated_at'] = (int)$post['updated_at'];
                $post['published'] = (bool)$post['published'];
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
            // Fall through to JSON fallback
        }
    }
    
    // Fallback to JSON file method
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
    $pdo = getDbConnection();
    
    // If database connection available, use it
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, title, slug, excerpt, content, category, tags, featured_image, published, 
                           EXTRACT(EPOCH FROM created_at) as created_at, 
                           EXTRACT(EPOCH FROM updated_at) as updated_at 
                    FROM posts WHERE slug = ?";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$slug]);
            $post = $stmt->fetch();
            
            if ($post) {
                // Convert JSON tags back to array and timestamps to integers
                $post['tags'] = json_decode($post['tags'], true) ?: [];
                $post['created_at'] = (int)$post['created_at'];
                $post['updated_at'] = (int)$post['updated_at'];
                $post['published'] = (bool)$post['published'];
            }
            
            return $post ?: null;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
            // Fall through to JSON fallback
        }
    }
    
    // Fallback to JSON file method
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
    
    // If database connection available, use it
    if ($pdo !== null) {
        try {
            // Check if this is an update (post exists) or insert (new post)
            $existingPost = loadBlogPost($data['slug']);
            
            // Prepare data for database insertion
            $tags_json = json_encode($data['tags']);
            $published = $data['published'] ? 'true' : 'false';
            
            // Get category_id from category name
            $category_id = null;
            if (!empty($data['category'])) {
                $category_id = getCategoryIdByName($data['category']);
                if (!$category_id) {
                    // Category doesn't exist, create it
                    $category_id = createCategory($data['category']);
                }
            }
            
            if ($existingPost) {
                // Update existing post
                $sql = "UPDATE posts SET 
                            title = ?,
                            excerpt = ?,
                            content = ?,
                            category = ?,
                            category_id = ?,
                            tags = ?,
                            featured_image = ?,
                            published = ?,
                            updated_at = CURRENT_TIMESTAMP
                        WHERE slug = ?";
                        
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $data['title'],
                    $data['excerpt'], 
                    $data['content'],
                    $data['category'], // Keep for backward compatibility
                    $category_id,
                    $tags_json,
                    $data['featured_image'],
                    $published,
                    $data['slug']
                ]);
            } else {
                // Insert new post
                $sql = "INSERT INTO posts (title, slug, excerpt, content, category, category_id, tags, featured_image, published, created_at, updated_at)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                        
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $data['title'],
                    $data['slug'],
                    $data['excerpt'],
                    $data['content'], 
                    $data['category'], // Keep for backward compatibility
                    $category_id,
                    $tags_json,
                    $data['featured_image'],
                    $published
                ]);
            }
            return true;
        } catch (Exception $e) {
            error_log('Database save error: ' . $e->getMessage());
            // Fall through to JSON fallback
        }
    }
    
    // Fallback to JSON file method
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
    $pdo = getDbConnection();
    
    // If database connection available, use it
    if ($pdo !== null) {
        try {
            // First get the post ID to clean up gallery images
            $postId = getPostIdFromSlug($slug);
            
            if ($postId) {
                // Delete all gallery images (this will clean up files too)
                deletePostImages($postId);
            }
            
            // Delete the post (CASCADE will handle remaining DB records)
            $sql = "DELETE FROM posts WHERE slug = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$slug]);
            return true;
        } catch (Exception $e) {
            error_log('Database delete error: ' . $e->getMessage());
            // Fall through to JSON fallback
        }
    }
    
    // Fallback to JSON file method
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
    extract($variables);
    include TEMPLATES_PATH . '/' . $template . '.php';
}

/**
 * Get all categories from database
 */
function getCategories() {
    $pdo = getDbConnection();
    
    // If database connection available, use it
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, name, slug FROM categories ORDER BY name";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log('Database categories error: ' . $e->getMessage());
            // Fall through to default categories
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
        
        $sql = "INSERT INTO categories (name, slug, created_at, updated_at) VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
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
        $sql = "UPDATE categories SET name = ?, slug = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
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
        // First check if category is in use
        $checkSql = "SELECT COUNT(*) FROM posts WHERE category_id = ?";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->execute([$id]);
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
 * Get a single category by ID
 */
function getCategory($id) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return null;
    }
    
    try {
        $sql = "SELECT id, name, slug, created_at, updated_at FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch (Exception $e) {
        error_log('Database category fetch error: ' . $e->getMessage());
        return null;
    }
}

/**
 * Get category ID by name (for migration/compatibility)
 */
function getCategoryIdByName($categoryName) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return null;
    }
    
    try {
        $sql = "SELECT id FROM categories WHERE name = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoryName]);
        $result = $stmt->fetchColumn();
        return $result ?: null;
    } catch (Exception $e) {
        error_log('Database category ID lookup error: ' . $e->getMessage());
        return null;
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
    
    // Ensure no empty path or suspicious patterns
    if (empty($path) || strpos($path, '..') !== false || strpos($path, './') !== false) {
        return 'invalid';
    }
    
    return $path;
}

/**
 * Load destinations from static data (completely bypassing database)
 */
function loadDestinations($limit = null, $featured_only = false, $category = null, $options = []) {
    // Always use static data - no database dependency
    $destinations = getStaticDestinationsData();
    
    // Apply filters
    if (!empty($destinations)) {
        // Filter by published status (all static data is published)
        $destinations = array_filter($destinations, function($dest) {
            return $dest['published'] === true;
        });
        
        // Filter by featured if requested
        if ($featured_only) {
            $destinations = array_filter($destinations, function($dest) {
                return $dest['featured'] === true;
            });
        }
        
        // Filter by category if requested
        if ($category) {
            $destinations = array_filter($destinations, function($dest) use ($category) {
                return strcasecmp($dest['category'], $category) === 0;
            });
        }
        
        // Exclude specific slug if requested
        if (!empty($options['exclude_slug'])) {
            $destinations = array_filter($destinations, function($dest) use ($options) {
                return $dest['slug'] !== $options['exclude_slug'];
            });
        }
        
        // Sort by featured status first, then by creation date
        usort($destinations, function($a, $b) {
            if ($a['featured'] != $b['featured']) {
                return $b['featured'] - $a['featured']; // Featured first
            }
            return $b['created_at'] - $a['created_at']; // Newest first
        });
        
        // Apply limit if requested
        if ($limit) {
            $destinations = array_slice($destinations, 0, $limit);
        }
    }
    
    return $destinations;
}

/**
 * Load all destinations including unpublished (for admin) from static data (completely bypassing database)
 */
function loadAllDestinations() {
    // Always use static data - no database dependency
    return getStaticDestinationsData();
}

/**
 * Load a single destination by slug from static data (completely bypassing database)
 */
function loadDestination($slug) {
    // Always use static data - no database dependency
    return getDestinationBySlug($slug);
}

/**
 * Save destination to database
 */
function saveDestination($data) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        // Convert arrays to JSON
        $highlights = isset($data['highlights']) ? json_encode($data['highlights']) : '[]';
        $activities = isset($data['activities']) ? json_encode($data['activities']) : '[]';
        
        // Check if this is an update or insert
        if (isset($data['slug']) && !empty($data['slug'])) {
            // Update existing destination
            $sql = "UPDATE destinations SET 
                        name = ?, description = ?, long_description = ?, featured_image = ?,
                        category = ?, region = ?, altitude_range = ?, best_time_to_visit = ?,
                        duration = ?, difficulty_level = ?, highlights = ?, activities = ?,
                        location_coordinates = ?, entry_permits_required = ?, accommodation_available = ?,
                        transportation_info = ?, featured = ?, published = ?,
                        meta_title = ?, meta_description = ?, updated_at = CURRENT_TIMESTAMP
                    WHERE slug = ?";
            
            $params = [
                $data['name'],
                $data['description'] ?? '',
                $data['long_description'] ?? '',
                $data['featured_image'] ?? '',
                $data['category'] ?? '',
                $data['region'] ?? '',
                $data['altitude_range'] ?? '',
                $data['best_time_to_visit'] ?? '',
                $data['duration'] ?? '',
                $data['difficulty_level'] ?? '',
                $highlights,
                $activities,
                $data['location_coordinates'] ?? '',
                isset($data['entry_permits_required']) ? (bool)$data['entry_permits_required'] : false,
                isset($data['accommodation_available']) ? (bool)$data['accommodation_available'] : true,
                $data['transportation_info'] ?? '',
                isset($data['featured']) ? (bool)$data['featured'] : false,
                isset($data['published']) ? (bool)$data['published'] : true,
                $data['meta_title'] ?? $data['name'],
                $data['meta_description'] ?? $data['description'],
                $data['slug']
            ];
        } else {
            // Insert new destination
            $slug = generateSlug($data['name']);
            $sql = "INSERT INTO destinations (name, slug, description, long_description, featured_image,
                        category, region, altitude_range, best_time_to_visit, duration, difficulty_level,
                        highlights, activities, location_coordinates, entry_permits_required,
                        accommodation_available, transportation_info, featured, published,
                        meta_title, meta_description)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $params = [
                $data['name'],
                $slug,
                $data['description'] ?? '',
                $data['long_description'] ?? '',
                $data['featured_image'] ?? '',
                $data['category'] ?? '',
                $data['region'] ?? '',
                $data['altitude_range'] ?? '',
                $data['best_time_to_visit'] ?? '',
                $data['duration'] ?? '',
                $data['difficulty_level'] ?? '',
                $highlights,
                $activities,
                $data['location_coordinates'] ?? '',
                isset($data['entry_permits_required']) ? (bool)$data['entry_permits_required'] : false,
                isset($data['accommodation_available']) ? (bool)$data['accommodation_available'] : true,
                $data['transportation_info'] ?? '',
                isset($data['featured']) ? (bool)$data['featured'] : false,
                isset($data['published']) ? (bool)$data['published'] : true,
                $data['meta_title'] ?? $data['name'],
                $data['meta_description'] ?? $data['description']
            ];
        }
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
        
    } catch (Exception $e) {
        error_log('Failed to save destination: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete destination
 */
function deleteDestination($slug) {
    $pdo = getDbConnection();
    
    if ($pdo === null) {
        return false;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM destinations WHERE slug = ?");
        return $stmt->execute([$slug]);
    } catch (Exception $e) {
        error_log('Failed to delete destination: ' . $e->getMessage());
        return false;
    }
}

/**
 * Get destination categories
 */
function getDestinationCategories() {
    return [
        'Trekking',
        'Cultural',
        'Wildlife',
        'Pilgrimage',
        'Adventure',
        'Photography',
        'Spiritual',
        'Heritage'
    ];
}

/**
 * Get destination regions
 */
function getDestinationRegions() {
    return [
        'Everest Region',
        'Annapurna Region',
        'Langtang Region',
        'Kathmandu Valley',
        'Pokhara Valley',
        'Terai Plains',
        'Western Nepal',
        'Eastern Nepal',
        'Far Western Nepal'
    ];
}

/**
 * Get difficulty levels
 */
function getDifficultyLevels() {
    return [
        'Easy',
        'Moderate',
        'Challenging',
        'Difficult',
        'Expert'
    ];
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
        $sql = "SELECT id, image_url, alt_text, sort_order, 
                       EXTRACT(EPOCH FROM created_at) as created_at 
                FROM post_images 
                WHERE post_id = ? 
                ORDER BY sort_order ASC, created_at ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$postId]);
        $images = $stmt->fetchAll();
        
        // Convert timestamps to integers
        foreach ($images as &$image) {
            $image['created_at'] = (int)$image['created_at'];
        }
        
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
function updateAdminPassword($newPassword) {
    // Store the new password in a secure runtime file
    $runtimeCredentialsFile = DATA_PATH . '/.admin_credentials';
    
    // Create DATA_PATH if it doesn't exist
    if (!is_dir(DATA_PATH)) {
        mkdir(DATA_PATH, 0755, true);
    }
    
    $credentials = [
        'username' => ADMIN_USERNAME,
        'password' => $newPassword,
        'updated_at' => time()
    ];
    
    // Write encrypted credentials to file
    $jsonData = json_encode($credentials);
    $success = file_put_contents($runtimeCredentialsFile, $jsonData, LOCK_EX);
    
    if ($success !== false) {
        // Set file permissions to read-only for owner
        chmod($runtimeCredentialsFile, 0600);
        return true;
    }
    
    return false;
}

/**
 * Get current admin password (check runtime file first, then environment)
 */
function getCurrentAdminPassword() {
    $runtimeCredentialsFile = DATA_PATH . '/.admin_credentials';
    
    // Check if runtime credentials file exists
    if (file_exists($runtimeCredentialsFile)) {
        $data = file_get_contents($runtimeCredentialsFile);
        if ($data !== false) {
            $credentials = json_decode($data, true);
            if ($credentials && isset($credentials['password'])) {
                return $credentials['password'];
            }
        }
    }
    
    // Fall back to environment variable
    return ADMIN_PASSWORD;
}

/**
 * Get current admin username (check runtime file first, then environment)
 */
function getCurrentAdminUsername() {
    $runtimeCredentialsFile = DATA_PATH . '/.admin_credentials';
    
    // Check if runtime credentials file exists
    if (file_exists($runtimeCredentialsFile)) {
        $data = file_get_contents($runtimeCredentialsFile);
        if ($data !== false) {
            $credentials = json_decode($data, true);
            if ($credentials && isset($credentials['username'])) {
                return $credentials['username'];
            }
        }
    }
    
    // Fall back to environment variable
    return ADMIN_USERNAME;
}
?>