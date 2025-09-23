<?php
// travelNepal Utility Functions

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
 * Load destinations from database
 */
function loadDestinations($limit = null, $featured_only = false, $category = null, $options = []) {
    $pdo = getDbConnection();
    
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, name, slug, description, long_description, featured_image, 
                           category, region, altitude_range, best_time_to_visit, duration, 
                           difficulty_level, highlights, activities, location_coordinates,
                           entry_permits_required, accommodation_available, transportation_info,
                           featured, published, meta_title, meta_description,
                           EXTRACT(EPOCH FROM created_at) as created_at,
                           EXTRACT(EPOCH FROM updated_at) as updated_at
                    FROM destinations WHERE published = true";
            
            $params = [];
            
            if ($featured_only) {
                $sql .= " AND featured = true";
            }
            
            if ($category) {
                $sql .= " AND category = ?";
                $params[] = $category;
            }
            
            if (!empty($options['exclude_slug'])) {
                $sql .= " AND slug != ?";
                $params[] = $options['exclude_slug'];
            }
            
            $sql .= " ORDER BY featured DESC, created_at DESC";
            
            if ($limit) {
                $sql .= " LIMIT " . intval($limit);
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $destinations = $stmt->fetchAll();
            
            // Convert JSON fields back to arrays and timestamps to integers
            foreach ($destinations as &$destination) {
                $destination['highlights'] = json_decode($destination['highlights'], true) ?: [];
                $destination['activities'] = json_decode($destination['activities'], true) ?: [];
                $destination['created_at'] = (int)$destination['created_at'];
                $destination['updated_at'] = (int)$destination['updated_at'];
                $destination['featured'] = (bool)$destination['featured'];
                $destination['published'] = (bool)$destination['published'];
                $destination['entry_permits_required'] = (bool)$destination['entry_permits_required'];
                $destination['accommodation_available'] = (bool)$destination['accommodation_available'];
            }
            
            return $destinations;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
        }
    }
    
    return [];
}

/**
 * Load all destinations including unpublished (for admin)
 */
function loadAllDestinations() {
    $pdo = getDbConnection();
    
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, name, slug, description, long_description, featured_image, 
                           category, region, altitude_range, best_time_to_visit, duration, 
                           difficulty_level, highlights, activities, location_coordinates,
                           entry_permits_required, accommodation_available, transportation_info,
                           featured, published, meta_title, meta_description,
                           EXTRACT(EPOCH FROM created_at) as created_at,
                           EXTRACT(EPOCH FROM updated_at) as updated_at
                    FROM destinations ORDER BY created_at DESC";
            
            $stmt = $pdo->query($sql);
            $destinations = $stmt->fetchAll();
            
            // Convert JSON fields back to arrays and timestamps to integers
            foreach ($destinations as &$destination) {
                $destination['highlights'] = json_decode($destination['highlights'], true) ?: [];
                $destination['activities'] = json_decode($destination['activities'], true) ?: [];
                $destination['created_at'] = (int)$destination['created_at'];
                $destination['updated_at'] = (int)$destination['updated_at'];
                $destination['featured'] = (bool)$destination['featured'];
                $destination['published'] = (bool)$destination['published'];
                $destination['entry_permits_required'] = (bool)$destination['entry_permits_required'];
                $destination['accommodation_available'] = (bool)$destination['accommodation_available'];
            }
            
            return $destinations;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
        }
    }
    
    return [];
}

/**
 * Load a single destination by slug
 */
function loadDestination($slug) {
    $pdo = getDbConnection();
    
    if ($pdo !== null) {
        try {
            $sql = "SELECT id, name, slug, description, long_description, featured_image, 
                           category, region, altitude_range, best_time_to_visit, duration, 
                           difficulty_level, highlights, activities, location_coordinates,
                           entry_permits_required, accommodation_available, transportation_info,
                           featured, published, meta_title, meta_description,
                           EXTRACT(EPOCH FROM created_at) as created_at,
                           EXTRACT(EPOCH FROM updated_at) as updated_at
                    FROM destinations WHERE slug = ? LIMIT 1";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$slug]);
            $destination = $stmt->fetch();
            
            if ($destination) {
                // Convert JSON fields back to arrays and timestamps to integers
                $destination['highlights'] = json_decode($destination['highlights'], true) ?: [];
                $destination['activities'] = json_decode($destination['activities'], true) ?: [];
                $destination['created_at'] = (int)$destination['created_at'];
                $destination['updated_at'] = (int)$destination['updated_at'];
                $destination['featured'] = (bool)$destination['featured'];
                $destination['published'] = (bool)$destination['published'];
                $destination['entry_permits_required'] = (bool)$destination['entry_permits_required'];
                $destination['accommodation_available'] = (bool)$destination['accommodation_available'];
            }
            
            return $destination;
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());
        }
    }
    
    return null;
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
?>