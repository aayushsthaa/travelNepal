<?php
/**
 * URL Fixer for travelNepal
 * 
 * This script automatically fixes all URL links in template files
 * to include the proper SITE_URL prefix
 */

// Load configuration
require_once 'config/config.php';

// Function to fix URLs in a file
function fixUrlsInFile($file) {
    $content = file_get_contents($file);
    $pattern = '/(href|action|src)="\/([^\/"][^"]*?)"/';
    $replacement = '$1="' . SITE_URL . '/$2"';
    
    $updated = preg_replace($pattern, $replacement, $content);
    
    if ($content !== $updated) {
        file_put_contents($file, $updated);
        return true;
    }
    
    return false;
}

// Function to recursively scan directory and fix URLs
function fixUrlsInDirectory($dir) {
    $fixed = 0;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            if (fixUrlsInFile($file->getPathname())) {
                echo "Fixed URLs in: " . $file->getPathname() . "<br>";
                $fixed++;
            }
        }
    }
    
    return $fixed;
}

// Start HTML output
echo "<!DOCTYPE html>
<html>
<head>
    <title>travelNepal URL Fixer</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
        h1 { color: #336699; }
        .success { color: green; font-weight: bold; }
        .info { color: #336699; }
        .back { margin-top: 20px; }
        .back a { 
            display: inline-block; 
            padding: 10px 15px; 
            background-color: #336699; 
            color: white; 
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>travelNepal URL Fixer</h1>";

// Fix URLs in templates directory
echo "<h2>Fixing URLs in Template Files</h2>";
$fixed = fixUrlsInDirectory(__DIR__ . '/templates');

if ($fixed > 0) {
    echo "<p class='success'>Successfully fixed URLs in $fixed files.</p>";
} else {
    echo "<p class='info'>No files needed URL fixes.</p>";
}

echo "<div class='back'>
    <a href='index.php'>Return to Homepage</a>
</div>
</body>
</html>";
?>