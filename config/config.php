<?php
// travelNepal Configuration File

// Site Configuration
define('SITE_NAME', 'travelNepal');
define('SITE_URL', 'http://localhost/travelNepal');
define('SITE_DESCRIPTION', 'Discover the breathtaking beauty of Nepal - Your ultimate travel guide to the Himalayas');

// Paths
define('BASE_PATH', __DIR__ . '/..');
define('TEMPLATES_PATH', BASE_PATH . '/templates');
define('ASSETS_PATH', BASE_PATH . '/assets');
define('DATA_PATH', BASE_PATH . '/data');
define('UPLOADS_PATH', BASE_PATH . '/uploads');

// Upload Configuration
define('MAX_UPLOAD_SIZE', 50 * 1024 * 1024); // 50MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/webp']);
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Set upload limits
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '60M'); // Slightly larger to account for form data
ini_set('max_input_time', 300); // 5 minutes for large uploads
ini_set('memory_limit', '256M');


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

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Configuration for MySQL/XAMPP - Hardcoded for simplicity
define('DB_HOST', 'localhost');
define('DB_NAME', 'travelnepal');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', 3306);

define('ENVIRONMENT', 'development');

/**
 * Get MySQL database connection (returns null if connection fails)
 */
function getDbConnection() {
    static $pdo = null;
    static $connection_attempted = false;
    
    if (!$connection_attempted) {
        $connection_attempted = true;
        try {
            // Use hardcoded database connection values
            $host = DB_HOST;
            $port = DB_PORT;
            $dbname = DB_NAME;
            $username = DB_USER;
            $password = DB_PASS;
            
            // Build MySQL DSN
            $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4", 
                          $host, $port, $dbname);
            
            // Create PDO connection with MySQL-specific options
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            ]);
            
            // Set MySQL session variables for better compatibility
            $pdo->exec("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO'");
            $pdo->exec("SET SESSION time_zone = '+00:00'");
            
        } catch (PDOException $e) {
            error_log('MySQL database connection failed: ' . $e->getMessage());
            $pdo = null; // Set to null so functions can handle gracefully
        }
    }
    
    return $pdo;
}

/**
 * Helper function to generate asset URLs for XAMPP compatibility
 */
function assetUrl($path) {
    $basePath = '/travelNepal'; // Change this if your XAMPP directory structure is different
    return $basePath . '/' . ltrim($path, '/');
}

/**
 * Helper function to generate site URLs for XAMPP compatibility
 */
function siteUrl($path = '') {
    $basePath = '/travelNepal'; // Change this if your XAMPP directory structure is different
    return $basePath . '/' . ltrim($path, '/');
}

// Create necessary directories
$directories = [DATA_PATH, ASSETS_PATH . '/images', TEMPLATES_PATH, UPLOADS_PATH];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}
?>
