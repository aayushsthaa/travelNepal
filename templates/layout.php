<?php
// Ensure config.php is included for assetUrl function and constants
if (!function_exists('assetUrl')) {
    require_once __DIR__ . '/../config/config.php';
}

// Set fallback values for variables that might not be defined
if (!isset($page_title)) {
    $page_title = '';
}
if (!isset($page_description)) {
    $page_description = '';
}
if (!isset($content)) {
    $content = '<div class="container mx-auto px-4 py-8"><div class="text-center"><h1 class="text-2xl font-bold text-gray-600 mb-4">No Content Available</h1><p class="text-gray-500">The page content could not be loaded.</p></div></div>';
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - ' . SITE_DESCRIPTION; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo assetUrl('assets/favicon.svg'); ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nepal: {
                            50: '#fef7f0',
                            100: '#fdede1',
                            200: '#fad8be',
                            300: '#f6bb91',
                            400: '#f19162',
                            500: '#ed703f',
                            600: '#de5429',
                            700: '#b93f1f',
                            800: '#93361e',
                            900: '#762f1c'
                        },
                        mountain: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'sans': ['Inter', 'sans-serif']
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'fade-in-down': 'fadeInDown 0.6s ease-out',
                        'slide-in-right': 'slideInRight 0.6s ease-out'
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        fadeInDown: {
                            '0%': { opacity: '0', transform: 'translateY(-30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideInRight: {
                            '0%': { opacity: '0', transform: 'translateX(30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Leaflet CSS for Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        .bg-hero-pattern {
            background-image: linear-gradient(135deg, rgba(237, 112, 63, 0.9) 0%, rgba(185, 63, 31, 0.9) 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #ed703f 0%, #b93f1f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Nepal Map Styling */
        .custom-nepal-marker {
            background: transparent;
            border: none;
        }
        
        .custom-nepal-marker .marker-pin {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ed703f 0%, #b93f1f 100%);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .custom-nepal-marker .marker-pin i {
            color: white;
            font-size: 16px;
            transform: rotate(45deg);
        }
        
        .leaflet-popup-content-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .leaflet-popup-content {
            margin: 0;
            padding: 16px;
            line-height: 1.5;
        }
        
        .custom-popup .map-popup h4 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 16px;
        }
        
        .custom-popup .map-popup p {
            color: #475569;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .leaflet-popup-tip {
            background: white;
            border: 1px solid #e2e8f0;
        }
        
        /* Map container responsive styling */
        #nepal-map {
            transition: opacity 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .custom-nepal-marker .marker-pin {
                width: 25px;
                height: 25px;
            }
            
            .custom-nepal-marker .marker-pin i {
                font-size: 14px;
            }
            
            .leaflet-popup-content {
                padding: 12px;
            }
        }
        
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <?php include __DIR__ . '/components/navbar.php'; ?>
    
    <!-- Main Content -->
    <main class="min-h-screen">
        <?php echo isset($content) ? $content : '<div class="container mx-auto px-4 py-8"><div class="text-center"><h1 class="text-2xl font-bold text-gray-600 mb-4">No Content Available</h1><p class="text-gray-500">The page content could not be loaded.</p></div></div>'; ?>
    </main>
    
    <!-- Footer -->
    <?php include __DIR__ . '/components/footer.php'; ?>
    
    <!-- JavaScript -->
    <script src="<?= SITE_URL ?>/assets/js/main.js"></script>
    
    <!-- Leaflet JavaScript for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>