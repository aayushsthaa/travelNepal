<?php
$page_title = 'Travel Blog - Nepal Adventures & Guides';
$page_description = 'Discover Nepal through our comprehensive travel blog featuring trekking guides, cultural insights, and adventure stories from the Himalayas.';

ob_start();
?>

<!-- Hero Section -->
<section class="relative py-24 bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="absolute inset-0 opacity-20">
        <img src="<?php echo SITE_URL; ?>/assets/images/Prayer_flags_mountain_vista_1f2256d5.png"
             alt="Nepal Mountains"
             class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-hero-pattern"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-display font-bold mb-6 animate-fade-in-down">
            Nepal Travel <span class="text-nepal-600">Adventures</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90 animate-fade-in-up">
            Expert guides, stunning photography, and insider tips for your Himalayan journey. 
            Discover the secrets of Nepal through our adventure-filled travel blog.
        </p>
        <div class="flex flex-wrap justify-center gap-4 animate-fade-in-up">
            <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm">
                <i class="fas fa-mountain mr-2"></i>Trekking Guides
            </span>
            <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm">
                <i class="fas fa-camera mr-2"></i>Photography Tips
            </span>
            <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm">
                <i class="fas fa-map-marked-alt mr-2"></i>Cultural Insights
            </span>
        </div>
    </div>
</section>

<!-- Blog Categories Filter -->
<section class="py-8 bg-white border-b border-mountain-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4">
            <button class="category-filter active bg-nepal-500 text-white px-6 py-2 rounded-full font-medium transition-all duration-300 hover:bg-nepal-600" data-category="all">
                All Posts
            </button>
            <?php
            $categories = getCategories();
            foreach ($categories as $category):
            ?>
            <button class="category-filter bg-mountain-100 text-mountain-700 px-6 py-2 rounded-full font-medium transition-all duration-300 hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 hover:text-white"
                    data-category="<?php echo htmlspecialchars($category['name']); ?>">
                <?php echo htmlspecialchars($category['name']); ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php 
        // Ensure $posts is defined for template safety
        if (!isset($posts)) $posts = [];
        if (!empty($posts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" id="blog-grid">
            <?php foreach ($posts as $post): ?>
            <article class="blog-post card-hover bg-white rounded-2xl shadow-lg overflow-hidden animate-on-scroll" data-category="<?php echo htmlspecialchars($post['category']); ?>">
                <div class="relative h-64">
                    <img src="<?php echo ensureFullImageUrl(htmlspecialchars($post['featured_image'])); ?>" 
                         alt="<?php echo htmlspecialchars($post['title']); ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-nepal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($post['category']); ?>
                        </span>
                    </div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <div class="flex items-center text-sm">
                            <i class="fas fa-clock mr-2"></i>
                            <span><?php echo calculateReadTime($post['content']); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center text-mountain-500 text-sm mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span><?php echo formatDate($post['created_at']); ?></span>
                        <div class="flex items-center ml-auto">
                            <?php foreach (array_slice($post['tags'], 0, 2) as $tag): ?>
                            <span class="bg-mountain-100 text-mountain-600 px-2 py-1 rounded text-xs mr-2">
                                #<?php echo htmlspecialchars($tag); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-mountain-800 mb-3 leading-tight">
                        <a href="<?php echo siteUrl('blog/' . htmlspecialchars($post['slug'])); ?>" 
                           class="hover:text-nepal-600 transition-colors">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </h2>
                    
                    <p class="text-mountain-600 mb-4 leading-relaxed">
                        <?php echo renderHtml($post['excerpt']); ?>
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <a href="<?php echo siteUrl('blog/' . htmlspecialchars($post['slug'])); ?>" 
                           class="inline-flex items-center text-nepal-600 hover:text-nepal-700 font-semibold transition-colors group">
                            Read Full Article 
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        
                        <div class="flex space-x-3 text-mountain-400">
                            <button class="hover:text-nepal-500 transition-colors" title="Share">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="hover:text-red-500 transition-colors" title="Like">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        
        <?php else: ?>
        <div class="text-center py-16">
            <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                <i class="fas fa-mountain text-mountain-300 text-6xl mb-6"></i>
                <h3 class="text-2xl font-bold text-mountain-700 mb-4">No Adventures Yet</h3>
                <p class="text-mountain-500 mb-6">
                    We're currently crafting amazing Nepal travel stories for you. Check back soon!
                </p>
                <a href="<?php echo siteUrl(); ?>" class="bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold px-8 py-3 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="py-16 bg-mountain-900 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h3 class="text-3xl md:text-4xl font-display font-bold mb-4">
            Join Fellow Adventurers
        </h3>
        <p class="text-xl mb-8 opacity-90">
            Get weekly Nepal travel tips, exclusive guides, and stories from fellow trekkers delivered to your inbox.
        </p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto" onsubmit="handleNewsletterSubmit(event)">
            <input type="email" 
                   placeholder="Your email address" 
                   required
                   class="flex-1 px-4 py-3 rounded-full text-mountain-800 focus:outline-none focus:ring-2 focus:ring-nepal-500">
            <button type="submit" class="bg-nepal-500 hover:bg-nepal-600 text-white px-8 py-3 rounded-full font-semibold transition-colors">
                <i class="fas fa-paper-plane mr-2"></i>
                Subscribe
            </button>
        </form>
    </div>
</section>

<script>
// Blog category filtering
document.addEventListener('DOMContentLoaded', function() {
    const categoryButtons = document.querySelectorAll('.category-filter');
    const blogPosts = document.querySelectorAll('.blog-post');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active', 'bg-nepal-500', 'text-white'));
            categoryButtons.forEach(btn => btn.classList.add('bg-mountain-100', 'text-mountain-700'));
            
            this.classList.add('active', 'bg-nepal-500', 'text-white');
            this.classList.remove('bg-mountain-100', 'text-mountain-700');
            
            // Filter posts
            blogPosts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                    post.classList.add('animate-fade-in-up');
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });
});

function handleNewsletterSubmit(event) {
    event.preventDefault();
    const email = event.target.querySelector('input[type="email"]').value;
    showNotification('Thanks for subscribing! Welcome to the travelNepal community.', 'success');
    event.target.reset();
}
</script>

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/layout.php';
?>
