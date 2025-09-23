<?php
$page_title = htmlspecialchars($destination['name'] ?? 'Destination');
$page_description = htmlspecialchars($destination['meta_description'] ?? $destination['description'] ?? 'Discover this amazing destination in Nepal.');

ob_start();
?>

<!-- Destination Hero Section -->
<section class="relative h-96 md:h-[500px] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo htmlspecialchars($destination['featured_image']); ?>" 
             alt="<?php echo htmlspecialchars($destination['name']); ?>" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
    </div>
    
    <div class="relative z-10 flex items-end h-full">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 text-white">
            <!-- Breadcrumb -->
            <nav class="mb-4">
                <ol class="flex items-center space-x-2 text-sm opacity-80">
                    <li><a href="/" class="hover:text-yellow-300 transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li><a href="/destinations" class="hover:text-yellow-300 transition-colors">Destinations</a></li>
                    <li><i class="fas fa-chevron-right mx-2"></i></li>
                    <li class="text-yellow-300"><?php echo htmlspecialchars($destination['name']); ?></li>
                </ol>
            </nav>
            
            <!-- Category Badge -->
            <div class="mb-4">
                <span class="bg-nepal-500 text-white px-4 py-2 rounded-full text-sm font-medium">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <?php echo htmlspecialchars($destination['category']); ?>
                </span>
                <?php if ($destination['region']): ?>
                <span class="bg-mountain-700 text-white px-4 py-2 rounded-full text-sm font-medium ml-2">
                    <i class="fas fa-globe mr-2"></i>
                    <?php echo htmlspecialchars($destination['region']); ?>
                </span>
                <?php endif; ?>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-display font-bold mb-4 leading-tight">
                <?php echo htmlspecialchars($destination['name']); ?>
            </h1>
            
            <!-- Description -->
            <p class="text-xl mb-6 opacity-90 max-w-2xl">
                <?php echo htmlspecialchars($destination['description']); ?>
            </p>
            
            <!-- Meta Information -->
            <div class="flex flex-wrap items-center gap-6 text-sm">
                <?php if ($destination['duration']): ?>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span><?php echo htmlspecialchars($destination['duration']); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($destination['difficulty_level']): ?>
                <div class="flex items-center">
                    <i class="fas fa-signal mr-2"></i>
                    <span><?php echo htmlspecialchars($destination['difficulty_level']); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($destination['altitude_range']): ?>
                <div class="flex items-center">
                    <i class="fas fa-mountain mr-2"></i>
                    <span><?php echo htmlspecialchars($destination['altitude_range']); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Destination Content -->
<article class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Content -->
        <div class="prose prose-lg max-w-none mb-12">
            <?php if ($destination['long_description']): ?>
                <div class="text-mountain-700 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($destination['long_description'])); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Quick Facts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php if ($destination['best_time_to_visit']): ?>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <i class="fas fa-calendar-alt text-nepal-500 text-xl mr-3"></i>
                    <h3 class="font-semibold text-mountain-800">Best Time to Visit</h3>
                </div>
                <p class="text-mountain-600"><?php echo htmlspecialchars($destination['best_time_to_visit']); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($destination['entry_permits_required']): ?>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <i class="fas fa-id-card text-nepal-500 text-xl mr-3"></i>
                    <h3 class="font-semibold text-mountain-800">Entry Permits</h3>
                </div>
                <p class="text-mountain-600">Special permits required</p>
            </div>
            <?php endif; ?>
            
            <?php if ($destination['accommodation_available']): ?>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-3">
                    <i class="fas fa-bed text-nepal-500 text-xl mr-3"></i>
                    <h3 class="font-semibold text-mountain-800">Accommodation</h3>
                </div>
                <p class="text-mountain-600">Various options available</p>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Highlights -->
        <?php if (!empty($destination['highlights'])): ?>
        <div class="mb-12">
            <h2 class="text-3xl font-display font-bold text-mountain-800 mb-6">Highlights</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($destination['highlights'] as $highlight): ?>
                <div class="flex items-center">
                    <i class="fas fa-check text-nepal-500 mr-3"></i>
                    <span class="text-mountain-700"><?php echo htmlspecialchars($highlight); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Activities -->
        <?php if (!empty($destination['activities'])): ?>
        <div class="mb-12">
            <h2 class="text-3xl font-display font-bold text-mountain-800 mb-6">Activities</h2>
            <div class="flex flex-wrap gap-3">
                <?php foreach ($destination['activities'] as $activity): ?>
                <span class="bg-nepal-100 text-nepal-700 px-4 py-2 rounded-full text-sm font-medium">
                    <?php echo htmlspecialchars($activity); ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Transportation -->
        <?php if ($destination['transportation_info']): ?>
        <div class="mb-12">
            <h2 class="text-3xl font-display font-bold text-mountain-800 mb-6">Getting There</h2>
            <div class="bg-blue-50 rounded-lg p-6">
                <div class="text-mountain-700">
                    <?php echo nl2br(htmlspecialchars($destination['transportation_info'])); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</article>

<!-- Related Destinations -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-display font-bold text-mountain-800 mb-8 text-center">
            Other Destinations You Might Like
        </h2>
        
        <?php 
        // Load other destinations (excluding current one)
        $relatedDestinations = loadDestinations(3, ['exclude_slug' => $destination['slug']]);
        if (!empty($relatedDestinations)): 
        ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($relatedDestinations as $relatedDest): ?>
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-48">
                    <img src="<?php echo htmlspecialchars($relatedDest['featured_image']); ?>" 
                         alt="<?php echo htmlspecialchars($relatedDest['name']); ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-nepal-500 px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($relatedDest['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-mountain-800 mb-2">
                        <?php echo htmlspecialchars($relatedDest['name']); ?>
                    </h3>
                    <p class="text-mountain-600 mb-4 text-sm">
                        <?php echo htmlspecialchars(truncateText($relatedDest['description'], 100)); ?>
                    </p>
                    <div class="flex items-center justify-between">
                        <?php if ($relatedDest['duration']): ?>
                        <span class="text-nepal-600 font-semibold text-sm">
                            <?php echo htmlspecialchars($relatedDest['duration']); ?>
                        </span>
                        <?php endif; ?>
                        <a href="/destination/<?php echo htmlspecialchars($relatedDest['slug']); ?>" 
                           class="text-nepal-600 hover:text-nepal-700 font-semibold text-sm">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
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
            Ready to Explore <?php echo htmlspecialchars($destination['name']); ?>?
        </h2>
        <p class="text-xl mb-8 opacity-90">
            Start planning your journey to this incredible destination today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/blog" class="bg-white text-nepal-600 hover:text-nepal-700 font-semibold px-8 py-3 rounded-full transition-colors">
                <i class="fas fa-book-open mr-2"></i>
                Read Travel Guides
            </a>
            <a href="/contact" class="border-2 border-white hover:bg-white hover:text-nepal-600 font-semibold px-8 py-3 rounded-full transition-colors">
                <i class="fas fa-envelope mr-2"></i>
                Plan Your Trip
            </a>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include TEMPLATES_PATH . '/layout.php';
?>