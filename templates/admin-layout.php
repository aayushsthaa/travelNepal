<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <?php if (!function_exists('assetUrl')) { require_once __DIR__ . '/../config/config.php'; } ?>
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
    
    <style>
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
        
        /* Admin-specific styles */
        .admin-body {
            overflow-x: hidden;
        }
        
        /* Sidebar toggle functionality */
        @media (max-width: 1024px) {
            .admin-sidebar-hidden {
                transform: translateX(-100%);
            }
        }
        
        /* Animation for sidebar toggle */
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans admin-body">
    <!-- Mobile sidebar overlay -->
    <div class="fixed inset-0 z-40 lg:hidden sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <!-- Main Admin Content (no header/footer) -->
    <main class="min-h-screen">
        <?php echo $content; ?>
    </main>
    
    <!-- Admin-specific JavaScript -->
    <script>
        // Sidebar toggle functionality for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar) {
                sidebar.classList.toggle('admin-sidebar-hidden');
                overlay.classList.toggle('active');
            }
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('admin-sidebar');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth < 1024 && sidebar && !sidebar.contains(e.target) && e.target !== toggleButton) {
                sidebar.classList.add('admin-sidebar-hidden');
                document.getElementById('sidebar-overlay').classList.remove('active');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth >= 1024) {
                if (sidebar) sidebar.classList.remove('admin-sidebar-hidden');
                if (overlay) overlay.classList.remove('active');
            }
        });
    </script>
    
    <!-- Include main.js for any shared functionality -->
    <script src="<?php echo assetUrl('assets/js/main.js'); ?>"></script>
</body>
</html>