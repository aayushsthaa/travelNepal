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
define('UPLOADS_PATH', BASE_PATH . '/uploads');

// Upload Configuration
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/webp']);
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Set PHP upload limits to match our constraints
ini_set('upload_max_filesize', '5M');
ini_set('post_max_size', '6M'); // Slightly larger to account for form data
ini_set('max_input_time', 60);
ini_set('memory_limit', '128M');

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

// Database Configuration
if (!isset($_ENV['DATABASE_URL']) || empty($_ENV['DATABASE_URL'])) {
    die('ERROR: DATABASE_URL environment variable is required for database connection.');
}

define('DATABASE_URL', $_ENV['DATABASE_URL']);
define('ENVIRONMENT', 'development');

/**
 * Get database connection (returns null if connection fails)
 */
function getDbConnection() {
    static $pdo = null;
    static $connection_attempted = false;
    
    if (!$connection_attempted) {
        $connection_attempted = true;
        try {
            // Parse the PostgreSQL URL to create proper DSN
            $dbUrl = DATABASE_URL;
            $parsed = parse_url($dbUrl);
            
            // Build DSN in the format PDO expects
            $dsn = sprintf("pgsql:host=%s;port=%d;dbname=%s;sslmode=prefer", 
                          $parsed['host'], 
                          $parsed['port'] ?? 5432, 
                          trim($parsed['path'], '/'));
            
            // Create PDO connection with parsed credentials
            $pdo = new PDO($dsn, $parsed['user'], $parsed['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            $pdo = null; // Set to null so functions can handle gracefully
        }
    }
    
    return $pdo;
}

// Create necessary directories
$directories = [DATA_PATH, ASSETS_PATH . '/images', TEMPLATES_PATH, UPLOADS_PATH];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}
?>