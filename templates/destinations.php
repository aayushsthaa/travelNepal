<?php
$page_title = 'Destinations - Explore Nepal\'s Most Beautiful Places';
$page_description = 'Discover Nepal\'s top destinations from the towering Himalayas to ancient cultural sites. Plan your perfect journey through Everest, Annapurna, Kathmandu Valley and more.';

ob_start();
?>

<!-- Destinations Hero Section -->
<section class="relative h-96 md:h-[500px] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="/assets/images/Prayer_flags_mountain_vista_1f2256d5.png" 
             alt="Nepal Mountain Vista" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-nepal-600/80 to-nepal-400/60"></div>
    </div>
    
    <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
        <div class="max-w-4xl mx-auto animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-display font-bold mb-6">
                Nepal <span class="text-yellow-300">Destinations</span>
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto font-light">
                From the world's highest peaks to ancient temples, discover the places that make Nepal extraordinary.
            </p>
        </div>
    </div>
</section>

<!-- Destinations List -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                Must-Visit <span class="text-gradient">Destinations</span>
            </h2>
            <p class="text-lg text-mountain-600 max-w-2xl mx-auto">
                Each destination in Nepal offers unique experiences, from challenging treks to spiritual journeys.
            </p>
        </div>
        
<?php if (!empty($destinations)): ?>
        <div class="grid gap-8 md:gap-12">
            <?php foreach ($destinations as $index => $destination): ?>
            <!-- <?= htmlspecialchars($destination['name']) ?> -->
            <div class="<?= $index < count($destinations) - 1 ? 'border-b border-gray-200 pb-8' : 'pb-8' ?>">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    <!-- Destination Image -->
                    <div class="lg:col-span-4">
                        <div class="relative overflow-hidden rounded-xl group">
                            <img src="<?= htmlspecialchars($destination['featured_image']) ?>" 
                                 alt="<?= htmlspecialchars($destination['name']) ?>" 
                                 class="w-full h-64 lg:h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            
                            <!-- Difficulty Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-mountain-800">
                                    <i class="fas fa-mountain mr-1"></i>
                                    <?= htmlspecialchars($destination['difficulty_level']) ?>
                                </span>
                            </div>
                            
                            <!-- Duration Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-nepal-500 text-white">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?= htmlspecialchars($destination['duration']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Destination Content -->
                    <div class="lg:col-span-8">
                        <div class="flex items-center gap-3 mb-3">
                            <h3 class="text-2xl md:text-3xl font-bold text-mountain-800">
                                <a href="/destination/<?= htmlspecialchars($destination['slug']) ?>" 
                                   class="hover:text-nepal-600 transition-colors">
                                    <?= htmlspecialchars($destination['name']) ?>
                                </a>
                            </h3>
                            <?php if ($destination['featured']): ?>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>
                                Featured
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Quick Info -->
                        <div class="flex flex-wrap gap-4 mb-4 text-sm text-mountain-600">
                            <span class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-1 text-nepal-500"></i>
                                <?= htmlspecialchars($destination['region']) ?>
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1 text-nepal-500"></i>
                                <?= htmlspecialchars($destination['best_time_to_visit']) ?>
                            </span>
                            <?php if (!empty($destination['altitude_range'])): ?>
                            <span class="flex items-center">
                                <i class="fas fa-arrow-up mr-1 text-nepal-500"></i>
                                <?= htmlspecialchars($destination['altitude_range']) ?>
                            </span>
                            <?php endif; ?>
                            <span class="flex items-center">
                                <i class="fas fa-tag mr-1 text-nepal-500"></i>
                                <?= htmlspecialchars($destination['category']) ?>
                            </span>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-lg text-mountain-600 leading-relaxed mb-4">
                            <?= htmlspecialchars($destination['description']) ?>
                        </p>
                        
                        <!-- Highlights -->
                        <?php if (!empty($destination['highlights']) && is_array($destination['highlights'])): ?>
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-mountain-800 mb-2">Key Highlights:</h4>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (array_slice($destination['highlights'], 0, 3) as $highlight): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-nepal-50 text-nepal-700 border border-nepal-200">
                                    <i class="fas fa-check mr-1"></i>
                                    <?= htmlspecialchars($highlight) ?>
                                </span>
                                <?php endforeach; ?>
                                <?php if (count($destination['highlights']) > 3): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-600">
                                    +<?= count($destination['highlights']) - 3 ?> more
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3">
                            <a href="/destination/<?= htmlspecialchars($destination['slug']) ?>" 
                               class="inline-flex items-center px-4 py-2 bg-nepal-600 hover:bg-nepal-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-info-circle mr-2"></i>
                                Learn More
                            </a>
                            <?php if ($destination['entry_permits_required']): ?>
                            <span class="inline-flex items-center px-3 py-2 bg-yellow-50 text-yellow-700 text-xs rounded-lg border border-yellow-200">
                                <i class="fas fa-id-card mr-1"></i>
                                Permits Required
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <div class="mx-auto max-w-md">
                <i class="fas fa-mountain text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Destinations Found</h3>
                <p class="text-gray-500">We're working on adding more amazing destinations to explore. Check back soon!</p>
            </div>
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
            Start planning your journey to these incredible destinations today.
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