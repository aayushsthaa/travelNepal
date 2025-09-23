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
 * Load blog posts from JSON files
 */
function loadBlogPosts($limit = null) {
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
            if ($post && $post['published']) {
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
    $filePath = DATA_PATH . "/posts/{$slug}.json";
    if (!file_exists($filePath)) {
        return null;
    }
    
    $content = file_get_contents($filePath);
    return json_decode($content, true);
}

/**
 * Save blog post to JSON file
 */
function saveBlogPost($data) {
    $dataPath = DATA_PATH . '/posts';
    if (!is_dir($dataPath)) {
        mkdir($dataPath, 0755, true);
    }
    
    $filePath = $dataPath . '/' . $data['slug'] . '.json';
    return file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
}

/**
 * Delete blog post
 */
function deleteBlogPost($slug) {
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
?>