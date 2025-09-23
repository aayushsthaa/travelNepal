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
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Everest Region -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Everest_sunrise_panorama_20949daa.png" 
                         alt="Everest Region" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-nepal-500 px-3 py-1 rounded-full text-sm font-medium">Trekking</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Everest Region</h3>
                    <p class="text-mountain-600 mb-4">
                        Home to the world's highest peak, offering the ultimate trekking experience through Sherpa villages and Buddhist monasteries.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Everest Base Camp Trek</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Gokyo Lakes</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Tengboche Monastery</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">14-16 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Annapurna Region -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Prayer_flags_mountain_vista_1f2256d5.png" 
                         alt="Annapurna Region" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-blue-500 px-3 py-1 rounded-full text-sm font-medium">Trekking</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Annapurna Region</h3>
                    <p class="text-mountain-600 mb-4">
                        Diverse landscapes from subtropical forests to high-altitude deserts, with spectacular mountain views.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Annapurna Circuit</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Annapurna Base Camp</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Thorong La Pass</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">12-21 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Kathmandu Valley -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Kathmandu_temple_architecture_df1e8ace.png" 
                         alt="Kathmandu Valley" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-purple-500 px-3 py-1 rounded-full text-sm font-medium">Culture</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Kathmandu Valley</h3>
                    <p class="text-mountain-600 mb-4">
                        A living museum of ancient art and architecture with seven UNESCO World Heritage Sites.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Durbar Squares</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Swayambhunath (Monkey Temple)</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Pashupatinath Temple</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">3-5 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Pokhara -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Pokhara_lake_reflections_ada62be7.png" 
                         alt="Pokhara" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-green-500 px-3 py-1 rounded-full text-sm font-medium">Adventure</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Pokhara</h3>
                    <p class="text-mountain-600 mb-4">
                        Nepal's adventure capital with stunning lake views and the gateway to Annapurna region.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Phewa Lake</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Paragliding</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>World Peace Pagoda</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">2-4 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Chitwan National Park -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Prayer_flags_mountain_vista_1f2256d5.png" 
                         alt="Chitwan National Park" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-orange-500 px-3 py-1 rounded-full text-sm font-medium">Wildlife</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Chitwan National Park</h3>
                    <p class="text-mountain-600 mb-4">
                        Nepal's first national park, home to endangered species including tigers and one-horned rhinos.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Jungle Safari</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Elephant Bathing</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Tharu Culture</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">2-3 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Lumbini -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Kathmandu_temple_architecture_df1e8ace.png" 
                         alt="Lumbini" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-yellow-500 px-3 py-1 rounded-full text-sm font-medium">Spiritual</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Lumbini</h3>
                    <p class="text-mountain-600 mb-4">
                        The birthplace of Lord Buddha, a sacred pilgrimage site for Buddhists worldwide.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Maya Devi Temple</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>International Monasteries</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Sacred Garden</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">1-2 days</span>
                        <a href="/blog" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                            Learn More <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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