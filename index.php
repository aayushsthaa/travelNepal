<?php
// travelNepal - Professional Travel Website for Nepal
require_once 'config/config.php';
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

// Admin login
$router->get('/admin/login', function() {
    if (isLoggedIn()) {
        header('Location: /admin/dashboard');
        exit();
    }
    includeTemplate('admin/login');
});

$router->post('/admin/login', function() {
    requireCSRF();
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/dashboard');
    } else {
        $error = 'Invalid credentials';
        includeTemplate('admin/login', compact('error'));
    }
});

// Admin logout
$router->get('/admin/logout', function() {
    session_destroy();
    header('Location: /');
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
        'featured_image' => sanitize($_POST['featured_image']),
        'category' => sanitize($_POST['category']),
        'tags' => array_map('sanitize', explode(',', $_POST['tags'] ?? '')),
        'published' => isset($_POST['published']),
        'updated_at' => time()
    ];
    
    if (isset($_POST['slug']) && !empty($_POST['slug'])) {
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
        header('Location: /admin/dashboard');
    } else {
        $error = 'Failed to save post';
        includeTemplate('admin/post-form', compact('data', 'error'));
    }
});

// Delete post
$router->post('/admin/post/delete/{slug}', function($slug) {
    requireAuth();
    requireCSRF();
    deleteBlogPost($slug);
    header('Location: /admin/dashboard');
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
    
    if (deleteCategory($id)) {
        header('Location: /admin/dashboard');
    } else {
        // Return to dashboard with error - could implement flash messages
        header('Location: /admin/dashboard');
    }
});

// Destinations page
$router->get('/destinations', function() {
    includeTemplate('destinations');
});

// About page
$router->get('/about', function() {
    includeTemplate('about');
});

// Contact page
$router->get('/contact', function() {
    includeTemplate('contact');
});

// Static assets (basic handling)
$router->get('/assets/{file}', function($file) {
    $filePath = ASSETS_PATH . '/' . $file;
    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath);
        header('Content-Type: ' . $mime);
        readfile($filePath);
    } else {
        http_response_code(404);
    }
});

// Run the router
$router->run();
?>