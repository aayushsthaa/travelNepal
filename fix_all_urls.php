<?php
// Script to fix all hardcoded URLs in template files

// Load configuration
require_once __DIR__ . '/config/config.php';

// Function to replace hardcoded URLs with SITE_URL
function replaceHardcodedUrls($directory) {
    $hardcodedUrl = 'http://localhost/travelNepal';
    $replacementUrl = '<?= SITE_URL ?>';
    
    // Get all PHP files in the directory
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    $count = 0;
    
    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $filePath = $file->getRealPath();
            $content = file_get_contents($filePath);
            
            // Replace hardcoded URLs
            $newContent = str_replace(
                ['href="' . $hardcodedUrl, 'href=\'' . $hardcodedUrl, 'action="' . $hardcodedUrl, 'action=\'' . $hardcodedUrl],
                ['href="' . $replacementUrl, 'href=\'' . $replacementUrl, 'action="' . $replacementUrl, 'action=\'' . $replacementUrl],
                $content
            );
            
            // If changes were made, save the file
            if ($content !== $newContent) {
                file_put_contents($filePath, $newContent);
                $count++;
                echo "Updated: " . $filePath . PHP_EOL;
            }
        }
    }
    
    return $count;
}

// Fix URLs in templates directory
$templatesDir = __DIR__ . '/templates';
$updatedFiles = replaceHardcodedUrls($templatesDir);

echo "Completed! Updated $updatedFiles files.";