<?php
/**
 * Error Logger for travelNepal
 * 
 * This script captures PHP errors and logs them to a file for easy debugging
 */

// Set error reporting level
error_reporting(E_ALL);

// Define log file path
define('ERROR_LOG_FILE', __DIR__ . '/error_log.txt');

// Custom error handler function
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    $error_message = date('[Y-m-d H:i:s]') . " Error: [$errno] $errstr in $errfile on line $errline\n";
    
    // Append to log file
    file_put_contents(ERROR_LOG_FILE, $error_message, FILE_APPEND);
    
    // Display error if in development mode
    if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
        echo "<div style='background-color:#ffdddd; border:1px solid #ff0000; padding:10px; margin:10px;'>";
        echo "<strong>Error:</strong> $errstr<br>";
        echo "<strong>File:</strong> $errfile<br>";
        echo "<strong>Line:</strong> $errline<br>";
        echo "</div>";
    }
    
    // Don't execute PHP's internal error handler
    return true;
}

// Set custom error handler
set_error_handler("customErrorHandler");

// Function to check the error log
function displayErrorLog() {
    if (file_exists(ERROR_LOG_FILE)) {
        $log_content = file_get_contents(ERROR_LOG_FILE);
        echo "<h2>Error Log</h2>";
        echo "<pre style='background-color:#f5f5f5; padding:10px; border:1px solid #ddd; overflow:auto; max-height:500px;'>";
        echo htmlspecialchars($log_content);
        echo "</pre>";
    } else {
        echo "<p>No error log file found.</p>";
    }
}

// Create a function to fix common URL issues
function fixSiteUrls() {
    // This function can be called to fix URL issues in templates
    // It will scan template files and replace absolute URLs with SITE_URL prefixed ones
    echo "<h2>URL Fixer</h2>";
    echo "<p>Scanning template files for URL issues...</p>";
    
    $templates_dir = __DIR__ . '/templates';
    $count = 0;
    
    if (is_dir($templates_dir)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($templates_dir)
        );
        
        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $content = file_get_contents($file->getPathname());
                $updated = preg_replace('/(href|action)="\/([^\/"][^"]*)"/', '$1="<?php echo SITE_URL; ?>/$2"', $content);
                
                if ($content !== $updated) {
                    file_put_contents($file->getPathname(), $updated);
                    $count++;
                    echo "<p>Fixed URLs in: " . $file->getPathname() . "</p>";
                }
            }
        }
    }
    
    echo "<p>Fixed URLs in $count files.</p>";
}

// Only run these functions if this script is accessed directly
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    // Display a simple UI for the error logger
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>travelNepal Error Logger</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            h1 { color: #336699; }
            .actions { margin: 20px 0; }
            .actions a { 
                display: inline-block; 
                padding: 10px 15px; 
                background-color: #336699; 
                color: white; 
                text-decoration: none;
                margin-right: 10px;
                border-radius: 4px;
            }
            .actions a:hover { background-color: #264d73; }
        </style>
    </head>
    <body>
        <h1>travelNepal Error Logger</h1>
        <div class='actions'>
            <a href='?action=view_log'>View Error Log</a>
            <a href='?action=clear_log'>Clear Error Log</a>
            <a href='?action=fix_urls'>Fix URL Issues</a>
            <a href='?action=test_site'>Test Site</a>
        </div>";
    
    // Handle actions
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'view_log':
                displayErrorLog();
                break;
                
            case 'clear_log':
                if (file_exists(ERROR_LOG_FILE)) {
                    unlink(ERROR_LOG_FILE);
                    echo "<p>Error log cleared successfully.</p>";
                } else {
                    echo "<p>No error log file to clear.</p>";
                }
                break;
                
            case 'fix_urls':
                fixSiteUrls();
                break;
                
            case 'test_site':
                echo "<h2>Site Test Results</h2>";
                
                // Test database connection
                echo "<h3>Database Connection</h3>";
                if (function_exists('getDbConnection')) {
                    $db = getDbConnection();
                    if ($db) {
                        echo "<p style='color:green;'>✓ Database connection successful</p>";
                    } else {
                        echo "<p style='color:red;'>✗ Database connection failed</p>";
                    }
                } else {
                    echo "<p style='color:red;'>✗ getDbConnection function not found</p>";
                }
                
                // Test template paths
                echo "<h3>Template Paths</h3>";
                if (defined('TEMPLATES_PATH')) {
                    if (is_dir(TEMPLATES_PATH)) {
                        echo "<p style='color:green;'>✓ Templates directory exists: " . TEMPLATES_PATH . "</p>";
                    } else {
                        echo "<p style='color:red;'>✗ Templates directory does not exist: " . TEMPLATES_PATH . "</p>";
                    }
                } else {
                    echo "<p style='color:red;'>✗ TEMPLATES_PATH constant not defined</p>";
                }
                
                // Test site URL
                echo "<h3>Site URL Configuration</h3>";
                if (defined('SITE_URL')) {
                    echo "<p style='color:green;'>✓ SITE_URL is defined as: " . SITE_URL . "</p>";
                } else {
                    echo "<p style='color:red;'>✗ SITE_URL constant not defined</p>";
                }
                
                break;
        }
    }
    
    echo "</body></html>";
}
?>