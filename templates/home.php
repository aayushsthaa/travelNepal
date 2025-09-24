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
        <img src="/assets/images/Everest_sunrise_panorama_20949daa.png" 
             alt="Mount Everest Sunrise" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-hero-pattern"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-5xl mx-auto animate-fade-in-up">
        <h1 class="text-5xl md:text-7xl font-display font-bold mb-6 leading-tight">
            Discover the <br><span class="text-yellow-300">Soul of Nepal</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto font-light">
            Journey through the breathtaking Himalayas, explore ancient cultural treasures, 
            and experience adventure like nowhere else on Earth.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="/blog" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-compass mr-3"></i>
                Explore Adventures
            </a>
            <a href="/destinations" class="bg-white text-nepal-600 border-2 border-nepal-500 hover:bg-nepal-500 hover:text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center">
                <i class="fas fa-mountain mr-3"></i>
                Discover Destinations
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
            <a href="/blog" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hidden sm:inline-flex items-center">
                <i class="fas fa-blog mr-2"></i>
                View All Posts
            </a>
        </div>
        
        <?php if (!empty($featured_posts)): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php foreach ($featured_posts as $index => $post): ?>
            <article class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden animate-on-scroll">
                <div class="relative h-48">
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
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
                    <h3 class="text-xl font-bold text-mountain-800 mb-3 leading-tight">
                        <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>" class="hover:text-nepal-600 transition-colors">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </h3>
                    <p class="text-mountain-600 mb-4">
                        <?php echo htmlspecialchars(truncateText($post['excerpt'], 120)); ?>
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (array_slice($post['tags'], 0, 2) as $tag): ?>
                            <span class="bg-mountain-100 text-mountain-700 px-2 py-1 rounded text-xs">
                                #<?php echo htmlspecialchars($tag); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>" 
                           class="text-nepal-600 hover:text-nepal-700 font-semibold text-sm">
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
            <a href="/blog" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-blog mr-2"></i>
                View All Posts
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-20 bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
        <h2 class="text-4xl md:text-5xl font-display font-bold mb-6">
            Ready for Your Nepal Adventure?
        </h2>
        <p class="text-xl mb-8 opacity-90">
            Join thousands of travelers who have discovered the magic of Nepal. 
            Start planning your journey to the roof of the world today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/blog" class="bg-white text-nepal-600 hover:text-nepal-700 font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1">
                <i class="fas fa-book-open mr-2"></i>
                Read Travel Guides
            </a>
            <a href="/contact" class="border-2 border-white hover:bg-white hover:text-nepal-600 font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1">
                <i class="fas fa-envelope mr-2"></i>
                Plan Your Trip
            </a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-mountain-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h3 class="text-3xl font-display font-bold text-mountain-800 mb-4">
                Never Miss an Adventure
            </h3>
            <p class="text-mountain-600 mb-6">
                Subscribe to our newsletter for the latest travel tips, destination guides, and exclusive Nepal travel insights.
            </p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto" onsubmit="handleNewsletterSubmit(event)">
                <input type="email" 
                       placeholder="Enter your email" 
                       required
                       class="flex-1 px-4 py-3 border border-mountain-200 rounded-full focus:outline-none focus:ring-2 focus:ring-nepal-500 focus:border-transparent">
                <button type="submit" 
                        class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg whitespace-nowrap">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Subscribe
                </button>
            </form>
        </div>
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