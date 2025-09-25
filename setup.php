<?php
// travelNepal Database Setup Script
// Run this script to initialize the database for XAMPP

// Load configuration
require_once 'config/config.php';
require_once 'includes/functions.php';

// Display header
echo "===========================================\n";
echo "travelNepal Database Setup Script for XAMPP\n";
echo "===========================================\n\n";

// Check if we can connect to MySQL
try {
    $pdo = new PDO("mysql:host=localhost;port=3306", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connected to MySQL server successfully\n";
} catch (PDOException $e) {
    die("❌ Failed to connect to MySQL server: " . $e->getMessage() . "\n");
}

// Create database if it doesn't exist
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `travelnepal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database 'travelnepal' created or already exists\n";
} catch (PDOException $e) {
    die("❌ Failed to create database: " . $e->getMessage() . "\n");
}

// Connect to the database
try {
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=travelnepal", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connected to 'travelnepal' database successfully\n";
} catch (PDOException $e) {
    die("❌ Failed to connect to database: " . $e->getMessage() . "\n");
}

// Import database schema
try {
    $sql = file_get_contents('database.sql');
    
    // Remove CREATE DATABASE statements as we've already created it
    $sql = preg_replace('/CREATE DATABASE.*?;/s', '', $sql);
    $sql = preg_replace('/USE.*?;/s', '', $sql);
    
    // Split into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
        }
    }
    
    echo "✓ Database schema imported successfully\n";
} catch (PDOException $e) {
    echo "❌ Error importing database schema: " . $e->getMessage() . "\n";
    // Continue execution as some tables might already exist
}

// Create sample data if tables are empty
try {
    // Check if categories table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM categories");
    $categoryCount = $stmt->fetchColumn();
    
    if ($categoryCount == 0) {
        // Insert sample categories
        $categories = [
            ['name' => 'Trekking', 'slug' => 'trekking'],
            ['name' => 'Cultural', 'slug' => 'cultural'],
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Wildlife', 'slug' => 'wildlife']
        ];
        
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        foreach ($categories as $category) {
            $stmt->execute([$category['name'], $category['slug']]);
        }
        
        echo "✓ Sample categories created\n";
    } else {
        echo "✓ Categories table already has data\n";
    }
    
    // Check if posts table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM posts");
    $postCount = $stmt->fetchColumn();
    
    if ($postCount == 0) {
        // Insert a sample post
        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, excerpt, content, category, featured_image, published) 
                               VALUES (?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([
            'Welcome to travelNepal',
            'welcome-to-travel-nepal',
            'Discover the breathtaking beauty of Nepal with our comprehensive travel guide.',
            '<p>Nepal is a land of incredible diversity, from the towering peaks of the Himalayas to the lush jungles of the Terai. Whether you\'re an adventure seeker looking to trek to Everest Base Camp or a cultural enthusiast eager to explore ancient temples, Nepal has something for everyone.</p><p>Stay tuned for more travel tips and destination guides!</p>',
            'Trekking',
            'assets/images/Everest_sunrise_panorama_20949daa.png'
        ]);
        
        echo "✓ Sample blog post created\n";
    } else {
        echo "✓ Posts table already has data\n";
    }
    

    
} catch (PDOException $e) {
    echo "❌ Error creating sample data: " . $e->getMessage() . "\n";
}

echo "\n===========================================\n";
echo "Setup completed successfully!\n";
echo "You can now access your website at: http://localhost/travelNepal/\n";
echo "===========================================\n";