<?php
$page_title = 'Destinations - Explore Nepal\'s Most Beautiful Places';
$page_description = 'Discover Nepal\'s top destinations from the towering Himalayas to ancient cultural sites. Plan your perfect journey through Everest, Annapurna, Kathmandu Valley and more.';

// Initialize variables with defaults if not set
$destinations = $destinations ?? [];

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
        <div class="space-y-16">
            <?php foreach ($destinations as $index => $destination): ?>
            <!-- <?= htmlspecialchars($destination['name']) ?> -->
            <div class="flex flex-col md:flex-row items-center gap-8 <?= $index % 2 === 1 ? 'md:flex-row-reverse' : '' ?>">
                <!-- Destination Image -->
                <div class="w-full md:w-1/2">
                    <img src="<?= htmlspecialchars($destination['featured_image']) ?>" 
                         alt="<?= htmlspecialchars($destination['name']) ?>" 
                         class="w-full h-64 md:h-80 object-cover rounded-lg">
                </div>
                
                <!-- Destination Content -->
                <div class="w-full md:w-1/2">
                    <h3 class="text-3xl md:text-4xl font-bold text-mountain-800 mb-4">
                        <?= htmlspecialchars($destination['name']) ?>
                    </h3>
                    
                    <p class="text-lg text-mountain-600 leading-relaxed mb-6">
                        <?= htmlspecialchars($destination['description']) ?>
                    </p>
                    
                    <!-- Basic Info -->
                    <div class="space-y-2 text-mountain-600">
                        <p><strong>Region:</strong> <?= htmlspecialchars($destination['region']) ?></p>
                        <p><strong>Best Time to Visit:</strong> <?= htmlspecialchars($destination['best_time_to_visit']) ?></p>
                        <?php if (!empty($destination['duration'])): ?>
                        <p><strong>Duration:</strong> <?= htmlspecialchars($destination['duration']) ?></p>
                        <?php endif; ?>
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