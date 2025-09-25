<nav class="bg-white shadow-lg sticky top-0 z-50" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo SITE_URL; ?>/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-nepal-500 to-nepal-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mountain text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-display font-bold text-gradient">travelNepal</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="flex items-center space-x-8">
                    <a href="<?php echo SITE_URL; ?>/" class="nav-link text-mountain-700 hover:text-nepal-600 font-medium transition-colors duration-200">Home</a>
                    <a href="<?php echo SITE_URL; ?>/blog" class="nav-link text-mountain-700 hover:text-nepal-600 font-medium transition-colors duration-200">Travel Blog</a>

<a href="<?php echo SITE_URL; ?>/about" class="nav-link text-mountain-700 hover:text-nepal-600 font-medium transition-colors duration-200">About</a>
<a href="<?php echo SITE_URL; ?>/contact" class="nav-link text-mountain-700 hover:text-nepal-600 font-medium transition-colors duration-200">Contact</a>
                    
                    <?php if (isLoggedIn()): ?>
                        <a href="<?php echo SITE_URL; ?>/admin/dashboard" class="bg-nepal-500 text-white px-4 py-2 rounded-full hover:bg-nepal-600 transition-colors duration-200">
                            <i class="fas fa-user-cog mr-2"></i>Admin
                        </a>
                        <a href="<?php echo SITE_URL; ?>/admin/logout" class="text-mountain-500 hover:text-nepal-600">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo SITE_URL; ?>/admin/login" class="text-mountain-500 hover:text-nepal-600">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-mountain-700 hover:text-nepal-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <div class="md:hidden mobile-menu hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
            <a href="<?php echo SITE_URL; ?>/" class="block px-3 py-2 text-mountain-700 hover:text-nepal-600 font-medium">Home</a>
            <a href="<?php echo SITE_URL; ?>/blog" class="block px-3 py-2 text-mountain-700 hover:text-nepal-600 font-medium">Travel Blog</a>
            
            <a href="<?php echo SITE_URL; ?>/about" class="block px-3 py-2 text-mountain-700 hover:text-nepal-600 font-medium">About</a>
            <a href="<?php echo SITE_URL; ?>/contact" class="block px-3 py-2 text-mountain-700 hover:text-nepal-600 font-medium">Contact</a>
            
            <?php if (isLoggedIn()): ?>
                <a href="<?php echo SITE_URL; ?>/admin/dashboard" class="block px-3 py-2 text-nepal-600 font-medium">
                    <i class="fas fa-user-cog mr-2"></i>Admin Dashboard
                </a>
                <a href="<?php echo SITE_URL; ?>/admin/logout" class="block px-3 py-2 text-mountain-500">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            <?php else: ?>
                <a href="<?php echo SITE_URL; ?>/admin/login" class="block px-3 py-2 text-mountain-500">
                    <i class="fas fa-sign-in-alt mr-2"></i>Admin Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>