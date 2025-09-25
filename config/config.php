<?php
// travelNepal Configuration File

// Load environment variables from .env file if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        $_ENV[$name] = $value;
        putenv(sprintf('%s=%s', $name, $value));
    }
}

// Set default admin credentials for XAMPP if not in environment
if (!isset($_ENV['ADMIN_USERNAME']) || empty($_ENV['ADMIN_USERNAME'])) {
    $_ENV['ADMIN_USERNAME'] = 'admin';
    putenv('ADMIN_USERNAME=admin');
}
if (!isset($_ENV['ADMIN_PASSWORD']) || empty($_ENV['ADMIN_PASSWORD'])) {
    $_ENV['ADMIN_PASSWORD'] = 'travelnepal2024';
    putenv('ADMIN_PASSWORD=travelnepal2024');
}

// Set default database URL for MySQL/XAMPP if not set
if (!isset($_ENV['DATABASE_URL']) || empty($_ENV['DATABASE_URL'])) {
    $_ENV['DATABASE_URL'] = 'mysql://root:@localhost:3306/travelnepal';
    putenv('DATABASE_URL=mysql://root:@localhost:3306/travelnepal');
}

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

// Database Configuration for MySQL/XAMPP
// Use either DATABASE_URL or individual connection parameters
if (isset($_ENV['DATABASE_URL']) && !empty($_ENV['DATABASE_URL'])) {
    define('DATABASE_URL', $_ENV['DATABASE_URL']);
} else {
    // XAMPP default MySQL configuration
    define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
    define('DB_NAME', $_ENV['DB_NAME'] ?? 'travel_nepal');
    define('DB_USER', $_ENV['DB_USER'] ?? 'root');
    define('DB_PASS', $_ENV['DB_PASS'] ?? '');
    define('DB_PORT', $_ENV['DB_PORT'] ?? 3306);
}

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
            if (defined('DATABASE_URL')) {
                // Parse MySQL URL if provided (e.g., mysql://user:pass@host:port/dbname)
                $dbUrl = DATABASE_URL;
                $parsed = parse_url($dbUrl);
                
                $host = $parsed['host'] ?? 'localhost';
                $port = $parsed['port'] ?? 3306;
                $dbname = trim($parsed['path'], '/');
                $username = $parsed['user'] ?? 'root';
                $password = $parsed['pass'] ?? '';
            } else {
                // Use individual connection parameters (XAMPP default)
                $host = DB_HOST;
                $port = DB_PORT;
                $dbname = DB_NAME;
                $username = DB_USER;
                $password = DB_PASS;
            }
            
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