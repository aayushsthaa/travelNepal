<?php
// travelNepal - Professional Travel Website for Nepal

// Load configuration before starting session
require_once 'config/config.php';

if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
}

// Start session after loading configuration (only if not already started)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'includes/functions.php';
require_once 'includes/router.php';

$router = new Router();

// Homepage
$router->get('/', function() {
    $featured_posts = loadBlogPosts(3);
    includeTemplate('home', compact('featured_posts'));
});

// Blog listing
$router->get('/blog', function() {
    $posts = loadBlogPosts();
    includeTemplate('blog/index', compact('posts'));
});



// Individual blog post
$router->get('/blog/{slug}', function($slug) {
    $post = loadBlogPost($slug);
    if (!$post) {
        http_response_code(404);
        includeTemplate('404');
        return;
    }
    includeTemplate('blog/post', compact('post'));
});

// Admin root redirect
$router->get('/admin', function() {
    if (isLoggedIn()) {
        header('Location: ' . siteUrl('admin/dashboard'));
    } else {
        header('Location: ' . siteUrl('admin/login'));
    }
    exit();
});

// Admin login
$router->get('/admin/login', function() {
    if (isLoggedIn()) {
        header('Location: ' . siteUrl('admin/dashboard'));
        exit();
    }
    
    // Check for password change success message
    $success = null;
    if (isset($_SESSION['password_change_success'])) {
        $success = $_SESSION['password_change_success'];
        unset($_SESSION['password_change_success']);
    }
    
    includeTemplate('admin/login', compact('success'));
});

$router->post('/admin/login', function() {
    requireCSRF();
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (authenticateUser($username, $password)) {
        // Authentication successful - session is set in authenticateUser function
        header('Location: ' . siteUrl('admin/dashboard'));
        exit();
    } else {
        $error = 'Invalid credentials';
        includeTemplate('admin/login', compact('error'));
    }
});

// Admin logout
$router->get('/admin/logout', function() {
    session_destroy();
    header('Location: ' . siteUrl());
    exit();
});

// Admin change password
$router->get('/admin/change-password', function() {
    requireAuth();
    includeTemplate('admin/change-password');
});

$router->post('/admin/change-password', function() {
    requireAuth();
    requireCSRF();
    
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate inputs
    if (empty($current_password)) {
        $error = "Current password is required";
        includeTemplate('admin/change-password', compact('error'));
        return;
    }
    
    if (empty($new_password)) {
        $error = "New password is required";
        includeTemplate('admin/change-password', compact('error'));
        return;
    }
    
    if ($new_password !== $confirm_password) {
        $error = "New passwords do not match";
        includeTemplate('admin/change-password', compact('error'));
        return;
    }
    
    if (strlen($new_password) < 8) {
        $error = "Password must be at least 8 characters long";
        includeTemplate('admin/change-password', compact('error'));
        return;
    }
    
    // Verify current password and update
    $result = changePassword($current_password, $new_password);
    
    if ($result === true) {
        $success = "Password changed successfully";
        includeTemplate('admin/change-password', compact('success'));
    } else {
        $error = $result;
        includeTemplate('admin/change-password', compact('error'));
    }
});

// Admin dashboard
$router->get('/admin/dashboard', function() {
    requireAuth();
    $posts = loadAllBlogPosts();
    includeTemplate('admin/dashboard', compact('posts'));
});

// Create/Edit post form
$router->get('/admin/post/create', function() {
    requireAuth();
    includeTemplate('admin/post-form');
});

$router->get('/admin/post/edit/{slug}', function($slug) {
    requireAuth();
    $post = loadBlogPost($slug);
    if (!$post) {
        http_response_code(404);
        includeTemplate('404');
        return;
    }
    includeTemplate('admin/post-form', compact('post'));
});

// Save post
$router->post('/admin/post/save', function() {
    requireAuth();
    requireCSRF();
    
    $data = [
        'title' => sanitize($_POST['title']),
        'content' => $_POST['content'], // Allow HTML for blog content
        'excerpt' => sanitize($_POST['excerpt']),
        'category' => sanitize($_POST['category']),
        'tags' => array_map('sanitize', explode(',', $_POST['tags'] ?? '')),
        'published' => isset($_POST['published']),
        'updated_at' => time()
    ];
    
    $isEditing = isset($_POST['slug']) && !empty($_POST['slug']);
    
    // Handle file upload
    $fileUploaded = isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] !== UPLOAD_ERR_NO_FILE;
    
    if ($fileUploaded) {
        $uploadResult = handleFileUpload($_FILES['image_upload']);
        
        if ($uploadResult['success']) {
            // Use uploaded file URL as featured image
            $data['featured_image'] = $uploadResult['url'];
        } else {
            // Return with upload error
            $error = 'Image upload failed: ' . $uploadResult['error'];
            $post = $data; // Keep form data for redisplay
            includeTemplate('admin/post-form', compact('post', 'error'));
            return;
        }
    }
    
    // For new posts, require image upload
    if (!$isEditing && !$fileUploaded) {
        $error = 'An image is required. Please upload an image for your blog post.';
        $post = $data; // Keep form data for redisplay
        includeTemplate('admin/post-form', compact('post', 'error'));
        return;
    }
    
    // For editing posts, keep existing image if no new upload
    if ($isEditing && !$fileUploaded) {
        $existing = loadBlogPost($_POST['slug']);
        if ($existing && !empty($existing['featured_image'])) {
            $data['featured_image'] = $existing['featured_image'];
        } else {
            $error = 'This post needs an image. Please upload an image.';
            $post = $data; // Keep form data for redisplay
            includeTemplate('admin/post-form', compact('post', 'error'));
            return;
        }
    }
    
    if ($isEditing) {
        // Editing existing post
        $data['slug'] = sanitize($_POST['slug']);
        $existing = loadBlogPost($data['slug']);
        if ($existing) {
            $data['created_at'] = $existing['created_at'];
        }
    } else {
        // Creating new post
        $data['slug'] = generateSlug($data['title']);
        $data['created_at'] = time();
    }
    
    if (saveBlogPost($data)) {
        // Get post ID for gallery image operations
        $postId = getPostIdFromSlug($data['slug']);
        
        if ($postId) {
            // Handle gallery image deletions
            if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
                foreach ($_POST['delete_images'] as $imageId) {
                    deletePostImage(intval($imageId));
                }
            }
            
            // Handle new gallery image uploads
            if (isset($_FILES['gallery_images']) && !empty($_FILES['gallery_images']['name'][0])) {
                $uploadResult = handleMultipleFileUploads($_FILES['gallery_images']);
                
                if ($uploadResult['success']) {
                    if (!empty($uploadResult['images'])) {
                        // Save gallery images
                        if (!savePostImages($postId, $uploadResult['images'])) {
                            error_log('Failed to save gallery images for post: ' . $data['slug']);
                        }
                    }
                    
                    // Log partial errors
                    if (!empty($uploadResult['partial_errors'])) {
                        error_log('Some gallery images failed to upload: ' . implode('; ', $uploadResult['partial_errors']));
                    }
                } else {
                    // Log gallery upload failure
                    error_log('Gallery image upload failed for post: ' . $data['slug'] . ' - ' . $uploadResult['error']);
                }
            }
        }
        
        header('Location: ' . siteUrl('admin/dashboard'));
    exit();
    } else {
        $error = 'Failed to save post';
        $post = $data; // Keep form data for redisplay
        includeTemplate('admin/post-form', compact('post', 'error'));
    }
});

// Delete a blog post
$router->post('/admin/post/delete/{slug}', function($slug) {
    requireAuth();
    requireCSRF();
    
    $result = deleteBlogPost($slug);
    
    if ($result) {
        $_SESSION['success_message'] = "Post deleted successfully";
    } else {
        $_SESSION['error_message'] = "Failed to delete post";
    }
    
    header('Location: ' . siteUrl('admin/dashboard'));
    exit;
});

// Category CRUD routes
$router->post('/admin/category/create', function() {
    requireAuth();
    requireCSRF();
    
    header('Content-Type: application/json');
    
    $name = sanitize($_POST['category_name'] ?? '');
    $slug = sanitize($_POST['category_slug'] ?? '');
    
    if (empty($name) || empty($slug)) {
        echo json_encode(['success' => false, 'message' => 'Name and slug are required']);
        return;
    }
    
    $categoryId = createCategory($name, $slug);
    if ($categoryId) {
        echo json_encode(['success' => true, 'id' => $categoryId]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create category']);
    }
});

$router->post('/admin/category/update/{id}', function($id) {
    requireAuth();
    requireCSRF();
    
    header('Content-Type: application/json');
    
    $name = sanitize($_POST['category_name'] ?? '');
    $slug = sanitize($_POST['category_slug'] ?? '');
    
    if (empty($name) || empty($slug)) {
        echo json_encode(['success' => false, 'message' => 'Name and slug are required']);
        return;
    }
    
    if (updateCategory($id, $name, $slug)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update category']);
    }
});

$router->post('/admin/category/delete/{id}', function($id) {
    requireAuth();
    requireCSRF();
    
    $result = deleteCategory($id);
    
    if (is_array($result) && isset($result['success'])) {
        if ($result['success']) {
            $_SESSION['success_message'] = "Category deleted successfully";
        } else {
            $_SESSION['error_message'] = $result['error'] ?? "Failed to delete category";
        }
    } elseif ($result === true) {
        $_SESSION['success_message'] = "Category deleted successfully";
    } else {
        $_SESSION['error_message'] = "Failed to delete category";
    }
    
    header('Location: ' . siteUrl('admin/dashboard'));
    exit;
});

// About page
$router->get('/about', function() {
    includeTemplate('about');
});

// Destinations page
$router->get('/destinations', function() {
    includeTemplate('destinations');
});

// Contact page
$router->get('/contact', function() {
    includeTemplate('contact');
});

// Static assets - Images in subdirectories
$router->get('/assets/images/{file}', function($file) {
    // Security: prevent directory traversal
    if (strpos($file, '..') !== false || strpos($file, '/') !== false || strpos($file, '\\') !== false) {
        http_response_code(404);
        return;
    }
    
    $filePath = ASSETS_PATH . '/images/' . $file;
    if (file_exists($filePath) && is_file($filePath)) {
        $mime = mime_content_type($filePath);
        header('Content-Type: ' . $mime);
        header('Cache-Control: public, max-age=31536000'); // Cache for 1 year
        readfile($filePath);
    } else {
        http_response_code(404);
    }
});

// Static assets (basic handling for root assets)
$router->get('/assets/{file}', function($file) {
    // Security: prevent directory traversal
    if (strpos($file, '..') !== false || strpos($file, '/') !== false || strpos($file, '\\') !== false) {
        http_response_code(404);
        return;
    }
    
    $filePath = ASSETS_PATH . '/' . $file;
    if (file_exists($filePath) && is_file($filePath)) {
        $mime = mime_content_type($filePath);
        header('Content-Type: ' . $mime);
        readfile($filePath);
    } else {
        http_response_code(404);
    }
});

// Uploaded files (secure handling)
$router->get('/uploads/{year}/{month}/{file}', function($year, $month, $file) {
    // Sanitize inputs to prevent directory traversal
    $year = sanitizeFilePath($year);
    $month = sanitizeFilePath($month);
    $file = sanitizeFilePath($file);
    
    // Validate year and month format
    if (!preg_match('/^\d{4}$/', $year) || !preg_match('/^\d{2}$/', $month)) {
        http_response_code(404);
        return;
    }
    
    // Validate file extension
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (!in_array($extension, ALLOWED_EXTENSIONS)) {
        http_response_code(404);
        return;
    }
    
    $filePath = UPLOADS_PATH . "/{$year}/{$month}/{$file}";
    
    if (file_exists($filePath) && is_file($filePath)) {
        // Get mime type and validate it's an image
        $mime = mime_content_type($filePath);
        if (!in_array($mime, ALLOWED_IMAGE_TYPES)) {
            http_response_code(404);
            return;
        }
        
        // Set security headers
        header('Content-Type: ' . $mime);
        header('X-Content-Type-Options: nosniff');
        header('Content-Security-Policy: default-src \'none\'; img-src \'self\'; style-src \'none\'; script-src \'none\';');
        
        // Cache headers for better performance
        $lastModified = filemtime($filePath);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
        header('Cache-Control: public, max-age=31536000'); // 1 year
        
        // Check if client has cached version
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $clientModified = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
            if ($clientModified >= $lastModified) {
                http_response_code(304);
                return;
            }
        }
        
        readfile($filePath);
    } else {
        http_response_code(404);
    }
});


// Run the router
$router->run();
?>
