<?php
// Check if post data exists, otherwise show 404
if (!isset($post) || !$post || !is_array($post)) {
    http_response_code(404);
    include TEMPLATES_PATH . '/404.php';
    exit;
}

$page_title = htmlspecialchars($post['title'] ?? 'Blog Post');
$page_description = htmlspecialchars($post['excerpt'] ?? 'Read this amazing Nepal travel story and adventure guide.');

ob_start();
?>

<!-- Article Header -->
<article class="max-w-4xl mx-auto">
    <!-- Hero Image -->
    <div class="relative h-96 md:h-[500px] overflow-hidden">
        <img src="<?php echo ensureFullImageUrl(htmlspecialchars($post['featured_image'])); ?>" 
             alt="<?php echo htmlspecialchars($post['title']); ?>" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        
        <!-- Article Meta Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-4">
                    <ol class="flex items-center space-x-2 text-sm opacity-80">
                        <li><a href="<?php echo siteUrl(); ?>" class="hover:text-yellow-300 transition-colors">Home</a></li>
                        <li><i class="fas fa-chevron-right mx-2"></i></li>
                        <li><a href="<?php echo siteUrl('blog'); ?>" class="hover:text-yellow-300 transition-colors">Blog</a></li>
                        <li><i class="fas fa-chevron-right mx-2"></i></li>
                        <li class="text-yellow-300"><?php echo htmlspecialchars($post['category']); ?></li>
                    </ol>
                </nav>
                
                <!-- Category Badge -->
                <div class="mb-4">
                    <span class="bg-nepal-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                        <i class="fas fa-tag mr-2"></i>
                        <?php echo htmlspecialchars($post['category']); ?>
                    </span>
                </div>
                
                <!-- Title -->
                <h1 class="text-5xl md:text-6xl font-display font-bold mb-4 leading-tight">
                    <?php echo htmlspecialchars($post['title']); ?>
                </h1>
                
                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-4 text-sm opacity-90">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span><?php echo formatDate($post['created_at']); ?></span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span><?php echo calculateReadTime($post['content']); ?></span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span>travelNepal Team</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Article Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Article Excerpt -->
            <?php if (!empty($post['excerpt'])): ?>
            <div class="bg-nepal-50 border-l-4 border-nepal-500 p-6 mb-8 rounded-r-lg">
                <blockquote class="text-lg text-mountain-700 leading-relaxed font-medium italic">
                    "<?php echo htmlspecialchars($post['excerpt']); ?>"
                </blockquote>
            </div>
            <?php endif; ?>

            <!-- Share Buttons -->
            <div class="flex items-center justify-between mb-8 pb-6 border-b border-mountain-200">
                <div class="text-mountain-600">
                    Share this adventure:
                </div>
                <div class="flex space-x-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors" onclick="shareArticle('facebook')" title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="bg-blue-400 hover:bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors" onclick="shareArticle('twitter')" title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors" onclick="shareArticle('pinterest')" title="Pin to Pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </button>
                    <button class="bg-mountain-500 hover:bg-mountain-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors" onclick="shareArticle('copy')" title="Copy Link">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>

            <!-- Article Body -->
            <div class="prose prose-lg prose-mountain max-w-none">
                <div class="article-content text-mountain-700 leading-relaxed">
                    <?php echo renderHtml($post['content']); ?>
                </div>
            </div>
            
            <!-- Image Gallery -->
            <?php
            $postId = getPostIdFromSlug($post['slug']);
            $galleryImages = $postId ? loadPostImages($postId) : [];
            if (!empty($galleryImages)):
            ?>
            <div class="mt-12 pt-8 border-t border-mountain-200">
                <h3 class="text-lg font-semibold text-mountain-800 mb-6 flex items-center">
                    <i class="fas fa-images mr-2 text-nepal-500"></i>
                    Gallery
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php foreach ($galleryImages as $index => $image): ?>
                    <div class="group cursor-pointer" onclick="openLightbox(<?php echo $index; ?>)">
                        <img src="<?php echo ensureFullImageUrl(htmlspecialchars($image['image_url'])); ?>" 
                             alt="<?php echo htmlspecialchars($image['alt_text'] ?: 'Gallery image ' . ($index + 1)); ?>"
                             class="w-full h-32 object-cover rounded-lg border border-mountain-200 group-hover:shadow-lg transition-all duration-300 transform group-hover:scale-105">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Lightbox Modal -->
            <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
                <div class="relative max-w-4xl max-h-full">
                    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10">
                        <i class="fas fa-times"></i>
                    </button>
                    <button onclick="prevImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 z-10">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 z-10">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-center">
                        <span id="lightbox-counter" class="text-sm opacity-80"></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Tags -->
            <div class="mt-12 pt-8 border-t border-mountain-200">
                <h3 class="text-lg font-semibold text-mountain-800 mb-4">Tags</h3>
                <div class="flex flex-wrap gap-3">
                    <?php if (isset($post['tags']) && is_array($post['tags']) && !empty($post['tags'])): ?>
                        <?php foreach ($post['tags'] as $tag): ?>
                        <span class="bg-mountain-100 hover:bg-nepal-100 text-mountain-700 hover:text-nepal-700 px-4 py-2 rounded-full text-sm transition-colors cursor-pointer">
                            #<?php echo htmlspecialchars($tag); ?>
                        </span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="text-mountain-500 italic">No tags available</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Posts -->
<section class="py-16 bg-mountain-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-12 text-center">
            More Nepal <span class="text-gradient">Adventures</span>
        </h2>
        
        <?php
        $all_posts = loadBlogPosts();
        $related_posts = [];
        if (is_array($all_posts)) {
            $related_posts = array_filter($all_posts, function($p) use ($post) {
                return $p['slug'] !== $post['slug'] && 
                       (in_array($post['category'] ?? '', [$p['category'] ?? '']) || 
                        count(array_intersect($post['tags'] ?? [], $p['tags'] ?? [])) > 0);
            });
            $related_posts = array_slice($related_posts, 0, 3);
        }
        ?>
        
        <?php if (!empty($related_posts)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($related_posts as $related_post): ?>
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-48">
                    <img src="<?php echo htmlspecialchars(ensureFullImageUrl($related_post['featured_image'])); ?>" 
                         alt="<?php echo htmlspecialchars($related_post['title']); ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-nepal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($related_post['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-mountain-800 mb-3">
                        <a href="<?php echo siteUrl('blog/' . htmlspecialchars($related_post['slug'])); ?>" 
                           class="hover:text-nepal-600 transition-colors">
                            <?php echo htmlspecialchars($related_post['title']); ?>
                        </a>
                    </h3>
                    <p class="text-mountain-600 mb-4">
                        <?php echo renderHtml($related_post['excerpt']); ?>
                    </p>
                    <a href="<?php echo siteUrl('blog/' . htmlspecialchars($related_post['slug'])); ?>" 
                       class="text-nepal-600 hover:text-nepal-700 font-semibold text-sm">
                        Read More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-6">
            Ready to Explore Nepal?
        </h2>
        <p class="text-xl mb-8 opacity-90">
            Let this story inspire your own Himalayan adventure. Start planning your journey today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo siteUrl('blog'); ?>" class="bg-white text-nepal-600 hover:text-nepal-700 font-semibold px-8 py-3 rounded-full transition-colors">
                <i class="fas fa-compass mr-2"></i>
                More Adventures
            </a>
            <a href="<?php echo siteUrl(); ?>" class="border-2 border-white hover:bg-white hover:text-nepal-600 font-semibold px-8 py-3 rounded-full transition-colors">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</section>

<script>
function shareArticle(platform) {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);
    const description = encodeURIComponent("<?php echo htmlspecialchars($post['excerpt']); ?>");
    
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
            break;
        case 'pinterest':
            shareUrl = `https://pinterest.com/pin/create/button/?url=${url}&description=${description}`;
            break;
        case 'copy':
            navigator.clipboard.writeText(window.location.href).then(() => {
                showNotification('Link copied to clipboard!', 'success');
            });
            return;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

// Smooth scroll for any anchor links in content
document.addEventListener('DOMContentLoaded', function() {
    const articleContent = document.querySelector('.article-content');
    if (articleContent) {
        // Style the content
        articleContent.querySelectorAll('h2').forEach(h2 => {
            h2.className = 'text-2xl md:text-3xl font-bold text-mountain-800 mt-12 mb-6';
        });
        
        articleContent.querySelectorAll('h3').forEach(h3 => {
            h3.className = 'text-xl md:text-2xl font-bold text-mountain-800 mt-10 mb-4';
        });
        
        articleContent.querySelectorAll('p').forEach(p => {
            p.className = 'mb-6 leading-relaxed';
        });
        
        articleContent.querySelectorAll('ul, ol').forEach(list => {
            list.className = 'mb-6 ml-6 space-y-2';
        });
        
        articleContent.querySelectorAll('li').forEach(li => {
            li.className = 'leading-relaxed';
        });
        
        articleContent.querySelectorAll('strong').forEach(strong => {
            strong.className = 'font-semibold text-mountain-800';
        });
        
        articleContent.querySelectorAll('a').forEach(a => {
            a.className = 'text-nepal-600 hover:text-nepal-700 font-medium underline transition-colors';
        });
    }
});

// Gallery Lightbox Functions
<?php if (!empty($galleryImages)): ?>
let currentImageIndex = 0;

// Pre-process gallery images to ensure full URLs
const galleryImages = <?php 
    $processedImages = array_map(function($image) {
        $image['image_url'] = ensureFullImageUrl($image['image_url']);
        return $image;
    }, array_values($galleryImages));
    echo json_encode($processedImages); 
?>;

function openLightbox(index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = galleryImages[currentImageIndex].image_url;
    lightboxImage.alt = galleryImages[currentImageIndex].alt_text || `Gallery image ${currentImageIndex + 1}`;
    lightboxCounter.textContent = `${currentImageIndex + 1} of ${galleryImages.length}`;
    
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateLightboxImage();
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightboxImage();
}

function updateLightboxImage() {
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = galleryImages[currentImageIndex].image_url;
    lightboxImage.alt = galleryImages[currentImageIndex].alt_text || `Gallery image ${currentImageIndex + 1}`;
    lightboxCounter.textContent = `${currentImageIndex + 1} of ${galleryImages.length}`;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox.classList.contains('hidden')) {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                prevImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    }
});

// Close lightbox when clicking outside the image
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});
<?php endif; ?>
</script>

<?php
$content = ob_get_contents();
ob_end_clean();
include TEMPLATES_PATH . '/layout.php';
?>
