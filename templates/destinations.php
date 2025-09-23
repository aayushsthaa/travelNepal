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

<!-- Destinations Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                Must-Visit <span class="text-gradient">Destinations</span>
            </h2>
            <p class="text-lg text-mountain-600 max-w-2xl mx-auto">
                Each destination in Nepal offers unique experiences, from challenging treks to spiritual journeys.
            </p>
        </div>
        
        <?php if (!empty($destinations)): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($destinations as $destination): ?>
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="<?php echo htmlspecialchars($destination['featured_image']); ?>" 
                         alt="<?php echo htmlspecialchars($destination['name']); ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <?php
                        $categoryColors = [
                            'Trekking' => 'bg-nepal-500',
                            'Cultural' => 'bg-purple-500',
                            'Adventure' => 'bg-green-500',
                            'Wildlife' => 'bg-orange-500',
                            'Pilgrimage' => 'bg-yellow-500',
                            'Spiritual' => 'bg-yellow-500',
                            'Heritage' => 'bg-purple-500',
                            'Photography' => 'bg-blue-500'
                        ];
                        $colorClass = $categoryColors[$destination['category']] ?? 'bg-gray-500';
                        ?>
                        <span class="<?php echo $colorClass; ?> px-3 py-1 rounded-full text-sm font-medium">
                            <?php echo htmlspecialchars($destination['category']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">
                        <?php echo htmlspecialchars($destination['name']); ?>
                    </h3>
                    <p class="text-mountain-600 mb-4">
                        <?php echo htmlspecialchars($destination['description']); ?>
                    </p>
                    <?php if (!empty($destination['highlights']) && is_array($destination['highlights'])): ?>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <?php foreach (array_slice($destination['highlights'], 0, 3) as $highlight): ?>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i><?php echo htmlspecialchars($highlight); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">
                            <?php echo htmlspecialchars($destination['duration'] ?: 'Varies'); ?>
                        </span>
                        <a href="/destination/<?php echo htmlspecialchars($destination['slug']); ?>" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-16">
            <i class="fas fa-mountain text-6xl text-mountain-300 mb-6"></i>
            <h3 class="text-2xl font-bold text-mountain-800 mb-4">No Destinations Found</h3>
            <p class="text-mountain-600">Check back soon for amazing Nepal destinations!</p>
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