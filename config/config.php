<?php
// travelNepal Configuration File

// Site Configuration
define('SITE_NAME', 'travelNepal');
define('SITE_URL', 'http://localhost:5000');
define('SITE_DESCRIPTION', 'Discover the breathtaking beauty of Nepal - Your ultimate travel guide to the Himalayas');

// Paths
define('BASE_PATH', __DIR__ . '/..');
define('TEMPLATES_PATH', BASE_PATH . '/templates');
define('ASSETS_PATH', BASE_PATH . '/assets');
define('DATA_PATH', BASE_PATH . '/data');

// Admin Configuration - Require environment variables for security
if (!isset($_ENV['ADMIN_USERNAME']) || empty($_ENV['ADMIN_USERNAME'])) {
    die('ERROR: ADMIN_USERNAME environment variable is required for security. Please set it in your environment.');
}
if (!isset($_ENV['ADMIN_PASSWORD']) || empty($_ENV['ADMIN_PASSWORD'])) {
    die('ERROR: ADMIN_PASSWORD environment variable is required for security. Please set it in your environment.');
}

define('ADMIN_USERNAME', $_ENV['ADMIN_USERNAME']);
define('ADMIN_PASSWORD', $_ENV['ADMIN_PASSWORD']);

// Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

// Set session.cookie_secure conditionally based on HTTPS/production environment
$isHTTPS = (
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
    (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] === 'https') ||
    (isset($_ENV['PRODUCTION_MODE']) && $_ENV['PRODUCTION_MODE'] === 'true')
);

ini_set('session.cookie_secure', $isHTTPS ? 1 : 0);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.cookie_lifetime', 3600); // 1 hour
ini_set('session.gc_maxlifetime', 3600); // 1 hour
ini_set('session.entropy_length', 32);
ini_set('session.hash_function', 'sha256');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create necessary directories
$directories = [DATA_PATH, ASSETS_PATH . '/images', TEMPLATES_PATH];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}
?>