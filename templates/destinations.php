<?php
$page_title = 'Destinations - travelNepal';
$page_description = 'Discover Nepal\'s magnificent destinations including Everest, Kathmandu Valley, Pokhara, and the Himalayan panorama. Plan your perfect Nepal adventure.';

ob_start();
?>

<!-- Hero Section -->
<section class="relative h-[62vh] overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-nepal-900/80 to-mountain-900/60 z-10"></div>
    <img src="<?php echo SITE_URL; ?>/assets/images/Everest_sunrise_panorama_20949daa.png" 
         alt="Everest sunrise panorama" 
         class="absolute inset-0 w-full h-full object-cover">
    <div class="relative z-20 h-full flex items-center justify-center text-center px-4">
        <div class="max-w-4xl">
            <h1 class="text-4xl md:text-6xl font-display font-bold text-white mb-6">
                Discover Nepal's Magnificent Destinations
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8">
                From the towering Himalayas to ancient temples, explore the wonders of the Himalayan kingdom
            </p>
        </div>
    </div>
</section>

<!-- Best Destinations Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-display font-bold text-mountain-900 mb-6">
                Best Places to Visit in <span class="text-gradient">Nepal</span>
            </h2>
            <p class="text-xl text-mountain-600 max-w-3xl mx-auto">
                Discover the most breathtaking destinations that make Nepal a once-in-a-lifetime experience
            </p>
        </div>

        <!-- Everest Base Camp Trek -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20 animate-on-scroll">
            <div class="order-2 lg:order-1">
                <img src="<?php echo SITE_URL; ?>/assets/images/Everest_sunrise_panorama_20949daa.png"
                     alt="Everest Base Camp Trek"
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
            <div class="order-1 lg:order-2">
                <h3 class="text-3xl font-display font-bold text-mountain-900 mb-4">
                    Everest Base Camp Trek
                </h3>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Journey to the foot of the world's highest mountain. This iconic trek takes you through Sherpa villages, 
                    ancient monasteries, and breathtaking Himalayan landscapes. Experience the thrill of standing at 5,364m 
                    with Mount Everest towering above you.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-nepal-100 text-nepal-800 px-4 py-2 rounded-full text-sm font-medium">14 Days</span>
                    <span class="bg-mountain-100 text-mountain-800 px-4 py-2 rounded-full text-sm font-medium">Challenging</span>
                    <span class="bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-sm font-medium">$1,200</span>
                </div>
                <div class="flex items-center text-mountain-500 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="font-medium">Eastern Nepal • Khumbu Region</span>
                </div>
                <div class="flex items-center text-mountain-500">
                    <i class="fas fa-mountain mr-2"></i>
                    <span class="font-medium">5,364m max altitude</span>
                </div>
            </div>
        </div>

        <!-- Kathmandu Valley Heritage -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20 animate-on-scroll">
            <div>
                <h3 class="text-3xl font-display font-bold text-mountain-900 mb-4">
                    Kathmandu Valley Heritage
                </h3>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Explore seven UNESCO World Heritage Sites in the cultural heart of Nepal. From the ancient temples 
                    of Kathmandu Durbar Square to the peaceful stupas of Swayambhunath and Boudhanath, discover centuries 
                    of art, architecture, and spiritual traditions.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-sm font-medium">3-5 Days</span>
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">Easy</span>
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">Cultural</span>
                </div>
                <div class="flex items-center text-mountain-500 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="font-medium">Central Nepal • Kathmandu Valley</span>
                </div>
                <div class="flex items-center text-mountain-500">
                    <i class="fas fa-landmark mr-2"></i>
                    <span class="font-medium">7 UNESCO Sites</span>
                </div>
            </div>
            <div>
                <img src="<?php echo SITE_URL; ?>/assets/images/Kathmandu_temple_architecture_df1e8ace.png" 
                     alt="Kathmandu Valley Heritage" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
        </div>

        <!-- Pokhara Lake City -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20 animate-on-scroll">
            <div class="order-2 lg:order-1">
                <img src="<?php echo SITE_URL; ?>/assets/images/Pokhara_lake_reflections_ada62be7.png"
                     alt="Pokhara Lake City"
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
            <div class="order-1 lg:order-2">
                <h3 class="text-3xl font-display font-bold text-mountain-900 mb-4">
                    Pokhara Lake City
                </h3>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Relax in Nepal's most beautiful city, nestled beneath the Annapurna range. Enjoy peaceful boat rides 
                    on Phewa Lake, witness sunrise from Sarangkot, and experience adventure activities like paragliding 
                    and ultralight flights.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">2-4 Days</span>
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">Relaxing</span>
                    <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-medium">Adventure</span>
                </div>
                <div class="flex items-center text-mountain-500 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="font-medium">Western Nepal • Gandaki Province</span>
                </div>
                <div class="flex items-center text-mountain-500">
                    <i class="fas fa-water mr-2"></i>
                    <span class="font-medium">820m altitude</span>
                </div>
            </div>
        </div>

        <!-- Annapurna Circuit -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20 animate-on-scroll">
            <div>
                <h3 class="text-3xl font-display font-bold text-mountain-900 mb-4">
                    Annapurna Circuit Trek
                </h3>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Circle the mighty Annapurna massif on one of the world's most diverse treks. Experience subtropical 
                    forests, alpine meadows, Tibetan culture, and cross the challenging Thorong La Pass at 5,416m. 
                    A complete Himalayan adventure.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-nepal-100 text-nepal-800 px-4 py-2 rounded-full text-sm font-medium">18-21 Days</span>
                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-medium">Strenuous</span>
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">Circuit</span>
                </div>
                <div class="flex items-center text-mountain-500 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="font-medium">Central Nepal • Annapurna Region</span>
                </div>
                <div class="flex items-center text-mountain-500">
                    <i class="fas fa-mountain mr-2"></i>
                    <span class="font-medium">5,416m max altitude</span>
                </div>
            </div>
            <div>
                <img src="<?php echo SITE_URL; ?>/assets/images/Prayer_flags_mountain_vista_1f2256d5.png" 
                     alt="Annapurna Circuit" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
        </div>

        <!-- Chitwan National Park -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center animate-on-scroll">
            <div class="order-2 lg:order-1">
                <img src="<?php echo SITE_URL; ?>/assets/images/Everest_sunrise_panorama_20949daa.png"
                     alt="Chitwan National Park"
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
            <div class="order-1 lg:order-2">
                <h3 class="text-3xl font-display font-bold text-mountain-900 mb-4">
                    Chitwan National Park
                </h3>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Discover Nepal's wild side in this UNESCO World Heritage Site. Spot endangered one-horned rhinoceros, 
                    Bengal tigers, and hundreds of bird species. Experience jungle safaris, elephant encounters, 
                    and Tharu cultural programs.
                </p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium">3-4 Days</span>
                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-medium">Wildlife</span>
                    <span class="bg-orange-100 text-orange-800 px-4 py-2 rounded-full text-sm font-medium">Safari</span>
                </div>
                <div class="flex items-center text-mountain-500 mb-4">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span class="font-medium">Southern Nepal • Terai Region</span>
                </div>
                <div class="flex items-center text-mountain-500">
                    <i class="fas fa-paw mr-2"></i>
                    <span class="font-medium">150m altitude</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-mountain-50">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 animate-on-scroll">
        <h2 class="text-4xl md:text-5xl font-display font-bold text-mountain-900 mb-6">
            Ready to Explore <span class="text-gradient">Nepal</span>?
        </h2>
        <p class="text-xl text-mountain-600 mb-10 leading-relaxed">
            These incredible destinations are just the beginning. Nepal offers endless adventures,
            from towering peaks to ancient cultures. Start planning your journey today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo SITE_URL; ?>/blog" class="bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-book-open mr-2"></i>
                Read Travel Stories
            </a>
            <a href="<?php echo SITE_URL; ?>/contact" class="bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg inline-flex items-center">
                <i class="fas fa-compass mr-2"></i>
                Plan Your Trip
            </a>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
includeTemplate('layout', ['content' => $content]);
?>
