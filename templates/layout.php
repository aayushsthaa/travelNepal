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
                        },
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
                        },
                        sky: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        },
                        violet: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7c3aed',
                            800: '#6b21a8',
                            900: '#581c87'
                        },
                        rose: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be185d',
                            800: '#9f1239',
                            900: '#881337'
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Leaflet CSS for Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <style>
        .bg-hero-pattern {
            background-image: linear-gradient(135deg, rgba(15, 23, 42, 0.7) 0%, rgba(30, 41, 59, 0.8) 100%);
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

        /* Prose typography styles for blog content */
        .prose {
            color: #374151;
            max-width: none;
        }

        .prose ul, .prose ol {
            margin-bottom: 1rem;
            margin-left: 1.5rem;
        }

        .prose ul {
            list-style-type: disc;
        }

        .prose ol {
            list-style-type: decimal;
        }

        .prose li {
            margin-bottom: 0.5rem;
            line-height: 1.625;
        }

        .prose p {
            margin-bottom: 1rem;
            line-height: 1.625;
        }

        .prose h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose h3 {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1e293b;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .prose strong {
            font-weight: 600;
            color: #1e293b;
        }

        .prose-lg h2 {
            font-size: 1.875rem;
        }

        .prose-lg h3 {
            font-size: 1.5rem;
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
    <script src="<?php echo assetUrl('assets/js/main.js'); ?>"></script>
    
    <!-- Leaflet JavaScript for Maps -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>
