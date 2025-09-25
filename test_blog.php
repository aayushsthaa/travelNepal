<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

echo "=== Blog Posts Test ===\n";
$posts = loadBlogPosts(5);
foreach($posts as $post) {
    echo "Title: " . $post['title'] . "\n";
    echo "Slug: " . $post['slug'] . "\n";
    echo "Featured Image: " . $post['featured_image'] . "\n";
    echo "---\n";
}