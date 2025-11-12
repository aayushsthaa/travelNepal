<footer class="bg-mountain-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Section -->
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="<?php echo SITE_URL; ?>/assets/images/logo.svg" alt="logo" class="w-20 h-20 bg-white rounded-full">
                    <span class="text-2xl font-display font-bold text-white">TravelNepal</span>
                </div>
                <p class="text-mountain-300 text-lg mb-6 max-w-md">
                    Discover the breathtaking beauty of Nepal with our expert travel guides, stunning photography, and insider tips for your Himalayan adventure.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-mountain-800 rounded-full flex items-center justify-center hover:bg-nepal-600 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-mountain-800 rounded-full flex items-center justify-center hover:bg-nepal-600 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-mountain-800 rounded-full flex items-center justify-center hover:bg-nepal-600 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-mountain-800 rounded-full flex items-center justify-center hover:bg-nepal-600 transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Explore</h3>
                <ul class="space-y-3">
                    <li><a href="<?php echo siteUrl(); ?>" class="text-mountain-300 hover:text-nepal-400 transition-colors">Home</a></li>
                    <li><a href="<?php echo siteUrl('blog'); ?>" class="text-mountain-300 hover:text-nepal-400 transition-colors">Travel Blog</a></li>
                    <li><a href="<?php echo siteUrl('destinations'); ?>" class="text-mountain-300 hover:text-nepal-400 transition-colors">Destinations</a></li>
                    <li><a href="<?php echo siteUrl('about'); ?>" class="text-mountain-300 hover:text-nepal-400 transition-colors">About Us</a></li>
                </ul>
            </div>
            

        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-mountain-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-mountain-400 text-sm">
                &copy; 2025 travelNepal. All rights reserved.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="<?php echo siteUrl('privacy'); ?>" class="text-mountain-400 hover:text-nepal-400 text-sm transition-colors">Privacy Policy</a>
                        <a href="<?php echo siteUrl('terms'); ?>" class="text-mountain-400 hover:text-nepal-400 text-sm transition-colors">Terms of Service</a>
                        <a href="<?php echo siteUrl('contact'); ?>" class="text-mountain-400 hover:text-nepal-400 text-sm transition-colors">Contact</a>
            </div>
        </div>
    </div>
</footer>