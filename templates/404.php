<?php
$page_title = '404 - Page Not Found';
$content = ob_get_clean();
ob_start();
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-nepal-50 to-mountain-100">
    <div class="text-center px-4">
        <div class="mb-8 animate-fade-in-down">
            <img src="<?php echo SITE_URL; ?>/assets/images/logo.svg" alt="logo" class="w-40 h-40 mx-auto">
            <h1 class="text-6xl font-display font-bold text-mountain-800 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-mountain-700 mb-6">Page Not Found</h2>
            <p class="text-mountain-600 text-lg mb-8 max-w-md mx-auto">
                Looks like you've wandered off the beaten path. The page you're looking for doesn't exist in our Himalayan adventure.
            </p>
        </div>
        
        <div class="space-x-4 animate-fade-in-up">
            <a href="<?php echo siteUrl(); ?>" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
            <a href="<?php echo siteUrl('blog'); ?>" class="bg-white text-nepal-600 border-2 border-nepal-500 hover:bg-nepal-500 hover:text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center">
                <i class="fas fa-compass mr-2"></i>
                Explore Blog
            </a>
        </div>
        
        <!-- Decorative Elements -->
        <div class="mt-16 opacity-20">
            <div class="flex justify-center space-x-8 text-nepal-600">
                <i class="fas fa-mountain text-4xl"></i>
                <i class="fas fa-hiking text-3xl mt-2"></i>
                <i class="fas fa-camera text-3xl mt-1"></i>
                <i class="fas fa-map text-3xl mt-2"></i>
                <i class="fas fa-mountain text-4xl"></i>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_contents();
ob_end_clean();
include 'layout.php';
?>
