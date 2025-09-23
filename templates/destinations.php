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
            
            <!-- Everest Base Camp -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Everest_sunrise_panorama_20949daa.png" 
                         alt="Everest Base Camp" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-nepal-500 px-3 py-1 rounded-full text-sm font-medium">Trekking</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">CHALLENGING</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Everest Base Camp</h3>
                    <p class="text-mountain-600 mb-4">
                        The ultimate trekking destination. Journey to the base of the world's highest peak and experience the raw beauty of the Himalayas at 5,364 meters.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Stand at 5,364m elevation</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Experience authentic Sherpa culture</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Visit historic Tengboche Monastery</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">12-16 Days</span>
                        <span class="text-xs bg-nepal-100 text-nepal-700 px-2 py-1 rounded-full">Best: Oct-Nov, Mar-May</span>
                    </div>
                </div>
            </div>

            <!-- Annapurna Circuit -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Prayer_flags_mountain_vista_1f2256d5.png" 
                         alt="Annapurna Circuit" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-nepal-500 px-3 py-1 rounded-full text-sm font-medium">Trekking</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-bold">MODERATE-HARD</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Annapurna Circuit</h3>
                    <p class="text-mountain-600 mb-4">
                        Classic Himalayan trek offering diverse landscapes from subtropical forests to alpine deserts, crossing the famous Thorong La Pass.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Cross Thorong La Pass (5,416m)</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Experience diverse climate zones</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Traditional Gurung villages</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">15-20 Days</span>
                        <span class="text-xs bg-nepal-100 text-nepal-700 px-2 py-1 rounded-full">Best: Oct-Nov, Mar-May</span>
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
                        <span class="bg-purple-500 px-3 py-1 rounded-full text-sm font-medium">Cultural</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">EASY</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Kathmandu Valley</h3>
                    <p class="text-mountain-600 mb-4">
                        UNESCO World Heritage site with seven monument zones showcasing ancient temples, palaces, and traditional Newari architecture spanning centuries.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Sacred Pashupatinath Temple</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Magnificent Boudhanath Stupa</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Historic Durbar Squares</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">2-4 Days</span>
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">Year-round</span>
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
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold">EASY-MODERATE</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Pokhara</h3>
                    <p class="text-mountain-600 mb-4">
                        Nepal's adventure capital offering stunning lake views, world-class paragliding, and serving as the gateway to Annapurna treks.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Serene Phewa Lake boating</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Thrilling paragliding adventures</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Stunning Annapurna range views</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">2-5 Days</span>
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Oct-Apr ideal</span>
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
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">EASY</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Chitwan National Park</h3>
                    <p class="text-mountain-600 mb-4">
                        UNESCO World Heritage site protecting endangered Bengal tigers, one-horned rhinos, and diverse wildlife in pristine tropical lowlands.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Bengal tiger spotting safaris</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>One-horned rhino encounters</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Elephant breeding center visit</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">2-4 Days</span>
                        <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">Oct-Mar ideal</span>
                    </div>
                </div>
            </div>

            <!-- Langtang Valley -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Everest_sunrise_panorama_20949daa.png" 
                         alt="Langtang Valley" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-nepal-500 px-3 py-1 rounded-full text-sm font-medium">Trekking</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs font-bold">MODERATE</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Langtang Valley</h3>
                    <p class="text-mountain-600 mb-4">
                        Known as the "Valley of Glaciers," offering spectacular mountain views, rich Tibetan culture, and sacred lakes closest to Kathmandu.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Majestic Langtang Lirung views</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Ancient Kyanjin Gompa monastery</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Sacred Gosaikunda lakes trek</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">7-12 Days</span>
                        <span class="text-xs bg-nepal-100 text-nepal-700 px-2 py-1 rounded-full">Best: Oct-Nov, Mar-May</span>
                    </div>
                </div>
            </div>

            <!-- Bandipur -->
            <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="relative h-64">
                    <img src="/assets/images/Kathmandu_temple_architecture_df1e8ace.png" 
                         alt="Bandipur" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <span class="bg-purple-500 px-3 py-1 rounded-full text-sm font-medium">Heritage</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">EASY</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Bandipur</h3>
                    <p class="text-mountain-600 mb-4">
                        Beautifully preserved medieval hilltop town with authentic 18th-century Newari architecture offering glimpse into traditional Nepal.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>18th-century preserved architecture</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Sacred Bindyabasini Temple</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Panoramic Himalayan views</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">1-2 Days</span>
                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">Year-round</span>
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
                        <span class="bg-yellow-500 px-3 py-1 rounded-full text-sm font-medium">Pilgrimage</span>
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">EASY</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-mountain-800 mb-3">Lumbini</h3>
                    <p class="text-mountain-600 mb-4">
                        UNESCO World Heritage site and sacred birthplace of Lord Buddha, featuring ancient ruins, peaceful gardens, and international monasteries.
                    </p>
                    <ul class="text-sm text-mountain-600 space-y-1 mb-4">
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Holy Maya Devi Temple</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>Sacred Bodhi Tree garden</li>
                        <li><i class="fas fa-check text-nepal-500 mr-2"></i>International monastery zone</li>
                    </ul>
                    <div class="flex items-center justify-between">
                        <span class="text-nepal-600 font-semibold">1-3 Days</span>
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Year-round</span>
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