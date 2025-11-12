<?php
$page_title = 'Discover Nepal - Your Ultimate Himalayan Adventure';
$page_description = 'Explore Nepal\'s breathtaking landscapes, rich culture, and incredible adventures. From Everest Base Camp to Kathmandu\'s ancient temples, discover your perfect Himalayan journey.';

// Initialize variables with defaults if not set
$featured_posts = $featured_posts ?? [];

ob_start();
?>

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo SITE_URL; ?>/assets/images/Everest_sunrise_panorama_20949daa.png" 
             alt="Mount Everest Sunrise" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-hero-pattern"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-5xl mx-auto animate-fade-in-up">
        <h1 class="text-5xl md:text-7xl font-display font-bold mb-6 leading-tight">
            Discover the <br><span class="text-nepal-300">Soul of Nepal</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto font-light">
            Journey through the breathtaking Himalayas, explore ancient cultural treasures, 
            and experience adventure like nowhere else on Earth.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="<?= SITE_URL ?>/blog" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                    <i class="fas fa-compass mr-3"></i>
                    Explore Adventures
                </a>
                <a href="<?= SITE_URL ?>/destinations" class="bg-white/90 hover:bg-white text-nepal-700 hover:text-nepal-800 font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                    <i class="fas fa-map-marked-alt mr-3"></i>
                    Explore Destinations
                </a>
            </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</section>


<!-- Featured Blog Posts Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-16 animate-on-scroll">
            <div>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-mountain-800 mb-4">
                    Latest <span class="text-gradient">Adventures</span>
                </h2>
                <p class="text-xl text-mountain-600">
                    Discover insider tips, stunning photography, and inspiring travel stories from Nepal.
                </p>
            </div>
            <a href="<?php echo siteUrl('blog'); ?>" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hidden sm:inline-flex items-center">
                <i class="fas fa-blog mr-2"></i>
                View All Posts
            </a>
        </div>
        
        <?php if (!empty($featured_posts)): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php foreach ($featured_posts as $index => $post): ?>
            <article class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden animate-on-scroll hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="relative h-48">
                    <img src="<?php echo htmlspecialchars(ensureFullImageUrl($post['featured_image'])); ?>" 
                         alt="<?php echo htmlspecialchars($post['title']); ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-nepal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($post['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-mountain-500 text-sm mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span><?php echo formatDate($post['created_at']); ?></span>
                        <i class="fas fa-clock ml-4 mr-2"></i>
                        <span>5 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-mountain-800 mb-3 leading-tight hover:text-nepal-600 transition-colors">
                        <a href="<?php echo siteUrl('blog/' . htmlspecialchars($post['slug'])); ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </h3>
                    <p class="text-mountain-600 mb-4">
                        <?php echo renderHtml($post['excerpt']); ?>
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (array_slice($post['tags'], 0, 2) as $tag): ?>
                            <span class="bg-mountain-100 text-mountain-700 px-2 py-1 rounded text-xs">
                                #<?php echo htmlspecialchars($tag); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo siteUrl('blog/' . htmlspecialchars($post['slug'])); ?>" 
                           class="text-nepal-600 hover:text-nepal-700 font-semibold text-sm hover:underline">
                            Read More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-mountain text-mountain-300 text-6xl mb-4"></i>
            <p class="text-mountain-500 text-xl">No blog posts available yet. Check back soon!</p>
        </div>
        <?php endif; ?>
        
        <div class="text-center mt-12 sm:hidden">
            <a href="<?php echo siteUrl('blog'); ?>" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-blog mr-2"></i>
                View All Posts
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Nepal Section -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-display font-bold text-center mb-4">Why Choose Nepal?</h2>
            <p class="text-xl text-nepal-300 text-center mb-16">Discover what makes Nepal truly magical</p>
            <p class="text-xl text-mountain-600 max-w-3xl mx-auto">
                From the world's highest peaks to ancient spiritual traditions, Nepal offers experiences that will transform your perspective forever.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Adventure Card -->
            <div class="card-hover bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-br from-nepal-500 to-nepal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-mountain text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-mountain-800 mb-4">Epic Adventures</h3>
                <p class="text-mountain-600 leading-relaxed">
                    Trek through the Himalayas, raft wild rivers, and experience the thrill of being on top of the world. Every step is an adventure waiting to unfold.
                </p>
            </div>
            
            <!-- Culture Card -->
            <div class="card-hover bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-br from-nepal-500 to-nepal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-om text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-mountain-800 mb-4">Rich Culture</h3>
                <p class="text-mountain-600 leading-relaxed">
                    Immerse yourself in centuries-old traditions, visit ancient temples, and witness spiritual practices that have remained unchanged for generations.
                </p>
            </div>
            
            <!-- Wildlife Card -->
            <div class="card-hover bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-br from-nepal-500 to-nepal-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-paw text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-mountain-800 mb-4">Incredible Wildlife</h3>
                <p class="text-mountain-600 leading-relaxed">
                    Spot Bengal tigers in Chitwan, observe rhinos in their natural habitat, and discover diverse ecosystems from jungle to alpine.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Travel Tips Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-display font-bold text-mountain-800 mb-6">
                    Essential Nepal Travel Tips
                </h2>
                <p class="text-xl text-mountain-600 mb-8">
                    Make the most of your Himalayan adventure with insider knowledge from experienced travelers and local experts.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-nepal-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-calendar-alt text-nepal-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-mountain-800 mb-2">Best Time to Visit</h4>
                            <p class="text-mountain-600">October-November and March-May offer the clearest skies and best trekking conditions.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-nepal-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-backpack text-nepal-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-mountain-800 mb-2">What to Pack</h4>
                            <p class="text-mountain-600">Layers are key! Pack light but include warm clothes for altitude and rain gear for unpredictable weather.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-nepal-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-heart text-nepal-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-mountain-800 mb-2">Cultural Respect</h4>
                            <p class="text-mountain-600">Remove shoes before entering temples, dress modestly, and always ask permission before photographing people.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2 animate-on-scroll">
                <div class="bg-gradient-to-br from-nepal-50 to-mountain-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-6 text-center">Quick Nepal Facts</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-nepal-600 mb-2">8,848m</div>
                            <div class="text-sm text-mountain-600">World's Highest Peak</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-nepal-600 mb-2">123+</div>
                            <div class="text-sm text-mountain-600">Ethnic Groups</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-nepal-600 mb-2">10</div>
                            <div class="text-sm text-mountain-600">UNESCO Sites</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-nepal-600 mb-2">75%</div>
                            <div class="text-sm text-mountain-600">Mountain Coverage</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Adventure Inspiration Section -->
<section class="py-20 bg-gradient-to-br from-mountain-900 to-mountain-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-display font-bold mb-6">
                Ready to Create Your Own Nepal Story?
            </h2>
            <p class="text-xl mb-12 opacity-90 max-w-3xl mx-auto">
                Every journey to Nepal is unique. Whether you're seeking spiritual enlightenment, adrenaline-pumping adventures, or peaceful mountain retreats, your perfect experience awaits.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <i class="fas fa-hiking text-4xl text-nepal-300 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Trekking Adventures</h4>
                    <p class="opacity-80">From gentle day hikes to challenging multi-day expeditions</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <i class="fas fa-camera text-4xl text-nepal-300 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Photography Tours</h4>
                    <p class="opacity-80">Capture stunning landscapes and vibrant cultural moments</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                    <i class="fas fa-spa text-4xl text-nepal-300 mb-4"></i>
                    <h4 class="text-xl font-semibold mb-3">Wellness Retreats</h4>
                    <p class="opacity-80">Find peace and rejuvenation in the Himalayas</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo siteUrl('blog'); ?>" class="bg-white text-mountain-800 hover:text-mountain-900 font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-book-open mr-2"></i>
                    Read Travel Guides
                </a>
                <a href="<?php echo siteUrl('contact'); ?>" class="border-2 border-white hover:bg-white hover:text-mountain-800 font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-envelope mr-2"></i>
                    Plan Your Trip
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
        <h2 class="text-4xl md:text-5xl font-display font-bold mb-6">
            Stay Updated with Nepal Adventures
        </h2>
        <p class="text-xl mb-8 opacity-90">
            Subscribe to our newsletter for the latest travel tips, destination guides, and exclusive offers delivered straight to your inbox.
        </p>
        <form action="<?php echo siteUrl('subscribe'); ?>" method="POST" class="max-w-md mx-auto">
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="email" name="email" placeholder="Enter your email address" required
                       class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-nepal-500 focus:border-transparent bg-white/90">
                <button type="submit" class="bg-nepal-500 hover:bg-nepal-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors shadow-md hover:shadow-lg">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function handleNewsletterSubmit(event) {
    event.preventDefault();
    const email = event.target.querySelector('input[type="email"]').value;
    showNotification('Thanks for subscribing! We\'ll keep you updated on Nepal adventures.', 'success');
    event.target.reset();
}
</script>

<?php
$content = ob_get_contents();
ob_end_clean();
include 'layout.php';
?>