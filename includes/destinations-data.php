<?php
/**
 * Static Nepal Destinations Data
 * 
 * This file contains comprehensive destination data for Nepal's most popular
 * tourist destinations including trekking routes, cultural sites, and natural attractions.
 */

/**
 * Get all static destinations data
 * 
 * @return array Array of destination data with complete information
 */
function getStaticDestinationsData() {
    return [
        // Everest Base Camp Trek
        [
            'id' => 1,
            'name' => 'Everest Base Camp Trek',
            'slug' => 'everest-base-camp-trek',
            'description' => 'The world\'s most famous trek to the base of Mount Everest, offering breathtaking mountain views and Sherpa culture.',
            'long_description' => 'The Everest Base Camp Trek is the ultimate adventure for mountain enthusiasts. This iconic journey takes you through the heart of the Khumbu region, following in the footsteps of legendary mountaineers. Experience the unique Sherpa culture, visit ancient monasteries, and witness some of the world\'s most spectacular mountain scenery including views of Everest, Lhotse, Nuptse, and Ama Dablam. The trek passes through Namche Bazaar, the bustling Sherpa capital, and the sacred Tengboche Monastery with its panoramic mountain views.',
            'featured_image' => '/assets/images/Everest_sunrise_panorama_20949daa.png',
            'category' => 'Trekking',
            'region' => 'Everest Region',
            'altitude_range' => '2,860m - 5,364m',
            'best_time_to_visit' => 'March-May, September-November',
            'duration' => '12-16 days',
            'difficulty_level' => 'Challenging',
            'highlights' => [
                'Stand at Everest Base Camp (5,364m)',
                'Climb Kala Patthar for the best Everest views',
                'Experience authentic Sherpa culture',
                'Visit Tengboche Monastery',
                'Cross the famous Hillary Suspension Bridge',
                'Explore Namche Bazaar markets'
            ],
            'activities' => [
                'High-altitude trekking',
                'Mountain photography',
                'Cultural immersion',
                'Monastery visits',
                'Acclimatization hikes',
                'Wildlife spotting'
            ],
            'location_coordinates' => '27.9881, 86.9250',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Fly to Lukla (Tenzing-Hillary Airport) from Kathmandu, then trek',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Everest Base Camp Trek - Ultimate Himalayan Adventure | travelNepal',
            'meta_description' => 'Experience the legendary Everest Base Camp Trek. 12-16 day adventure through Sherpa culture, stunning mountain views, and the world\'s highest peaks.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Annapurna Circuit Trek
        [
            'id' => 2,
            'name' => 'Annapurna Circuit Trek',
            'slug' => 'annapurna-circuit-trek',
            'description' => 'One of the world\'s classic treks offering diverse landscapes, from subtropical forests to high alpine terrain.',
            'long_description' => 'The Annapurna Circuit Trek is renowned for its incredible diversity of landscapes, cultures, and ecosystems. This classic trek takes you around the entire Annapurna massif, crossing the challenging Thorong La Pass at 5,416 meters. Experience everything from lush rhododendron forests and terraced fields to barren high-altitude deserts. The trek passes through traditional villages of different ethnic groups including Gurungs, Thakalis, and Tibetan communities. Witness spectacular views of Annapurna I, Dhaulagiri, Machapuchare, and other towering peaks.',
            'featured_image' => '/assets/images/Prayer_flags_mountain_vista_1f2256d5.png',
            'category' => 'Trekking',
            'region' => 'Annapurna Region',
            'altitude_range' => '760m - 5,416m',
            'best_time_to_visit' => 'March-May, September-November',
            'duration' => '15-20 days',
            'difficulty_level' => 'Challenging',
            'highlights' => [
                'Cross Thorong La Pass (5,416m)',
                'Visit sacred Muktinath Temple',
                'Experience diverse ecosystems',
                'Traditional village cultures',
                'Panoramic mountain views',
                'Natural hot springs in Tatopani'
            ],
            'activities' => [
                'High-altitude trekking',
                'Cultural village tours',
                'Temple visits',
                'Hot spring relaxation',
                'Photography',
                'Local cuisine tasting'
            ],
            'location_coordinates' => '28.5967, 83.8206',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Drive to Besisahar or fly to Pokhara, then drive to trek starting point',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Annapurna Circuit Trek - Classic Himalayan Journey | travelNepal',
            'meta_description' => 'Discover the famous Annapurna Circuit Trek. Experience diverse landscapes, rich cultures, and cross the challenging Thorong La Pass.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Pokhara
        [
            'id' => 3,
            'name' => 'Pokhara',
            'slug' => 'pokhara',
            'description' => 'Nepal\'s adventure capital and gateway to the Annapurnas, famous for Phewa Lake and stunning mountain views.',
            'long_description' => 'Pokhara is Nepal\'s premier tourist destination and adventure capital, nestled in a tranquil valley beneath the Annapurna range. The city is famous for its pristine lakes, especially Phewa Lake with its iconic Tal Barahi Temple, and spectacular mountain views including the distinctive fish-tail peak of Machapuchare. Pokhara serves as the gateway to numerous trekking routes and offers a perfect blend of natural beauty, adventure activities, and relaxation. The lakeside area buzzes with cafes, restaurants, and shops, while the surrounding hills offer excellent hiking opportunities.',
            'featured_image' => '/assets/images/Pokhara_lake_reflections_ada62be7.png',
            'category' => 'City & Culture',
            'region' => 'Western Nepal',
            'altitude_range' => '822m',
            'best_time_to_visit' => 'October-April',
            'duration' => '2-5 days',
            'difficulty_level' => 'Easy',
            'highlights' => [
                'Phewa Lake boating and reflection views',
                'Sarangkot sunrise over Annapurnas',
                'World Peace Pagoda',
                'Davis Falls waterfall',
                'Gupteshwor Cave exploration',
                'Tal Barahi Temple visit'
            ],
            'activities' => [
                'Lake boating',
                'Paragliding',
                'Hiking and trekking',
                'Mountain biking',
                'Zip-lining',
                'Cultural tours',
                'Yoga and meditation',
                'Photography'
            ],
            'location_coordinates' => '28.2096, 83.9856',
            'entry_permits_required' => false,
            'accommodation_available' => true,
            'transportation_info' => 'Direct flights from Kathmandu (25 minutes) or scenic drive (6-7 hours)',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Pokhara - Nepal\'s Adventure Capital | Lake City Guide',
            'meta_description' => 'Explore beautiful Pokhara, Nepal\'s adventure capital. Enjoy lake activities, mountain views, and gateway to Annapurna treks.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Kathmandu Valley
        [
            'id' => 4,
            'name' => 'Kathmandu Valley',
            'slug' => 'kathmandu-valley',
            'description' => 'UNESCO World Heritage sites, ancient temples, and vibrant culture in Nepal\'s historic capital valley.',
            'long_description' => 'The Kathmandu Valley is the cultural and historical heart of Nepal, home to seven UNESCO World Heritage Sites that showcase centuries of artistic and architectural achievements. This ancient valley houses three medieval cities: Kathmandu, Patan, and Bhaktapur, each with their own unique character and royal heritage. Explore magnificent Durbar Squares with their intricate wood carvings, visit sacred temples like Pashupatinath and Swayambhunath, and experience the living heritage where ancient traditions blend seamlessly with modern life. The valley offers an incredible concentration of cultural treasures within a small area.',
            'featured_image' => '/assets/images/Kathmandu_temple_architecture_df1e8ace.png',
            'category' => 'Culture & Heritage',
            'region' => 'Central Nepal',
            'altitude_range' => '1,400m',
            'best_time_to_visit' => 'October-March',
            'duration' => '3-7 days',
            'difficulty_level' => 'Easy',
            'highlights' => [
                'Kathmandu Durbar Square',
                'Patan Durbar Square',
                'Bhaktapur medieval city',
                'Pashupatinath Temple',
                'Swayambhunath (Monkey Temple)',
                'Boudhanath Stupa',
                'Traditional Newari architecture'
            ],
            'activities' => [
                'Cultural heritage tours',
                'Temple visits',
                'Traditional craft workshops',
                'Local cuisine tours',
                'Photography walks',
                'Museum visits',
                'Shopping for handicrafts'
            ],
            'location_coordinates' => '27.7172, 85.3240',
            'entry_permits_required' => false,
            'accommodation_available' => true,
            'transportation_info' => 'International gateway via Tribhuvan International Airport',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Kathmandu Valley - UNESCO Heritage Sites & Nepal Culture',
            'meta_description' => 'Discover Kathmandu Valley\'s UNESCO World Heritage sites, ancient temples, and rich Newari culture in Nepal\'s historic capital.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Chitwan National Park
        [
            'id' => 5,
            'name' => 'Chitwan National Park',
            'slug' => 'chitwan-national-park',
            'description' => 'Nepal\'s premier wildlife destination, home to rhinos, tigers, and diverse jungle ecosystems.',
            'long_description' => 'Chitwan National Park is Nepal\'s first national park and a UNESCO World Heritage Site, renowned for its successful conservation programs and incredible wildlife diversity. The park protects one of the last remaining examples of the Terai\'s natural ecosystems, including grasslands, riverine forests, and sal forests. Home to the endangered one-horned rhinoceros and Bengal tigers, Chitwan offers exceptional wildlife viewing opportunities. Experience authentic jungle adventures through elephant safaris, canoe trips, and nature walks while staying in traditional jungle lodges or community homestays.',
            'featured_image' => '/assets/images/Prayer_flags_mountain_vista_1f2256d5.png',
            'category' => 'Wildlife & Nature',
            'region' => 'Central Terai',
            'altitude_range' => '100m - 815m',
            'best_time_to_visit' => 'October-March',
            'duration' => '2-4 days',
            'difficulty_level' => 'Easy',
            'highlights' => [
                'One-horned rhinoceros sightings',
                'Bengal tiger tracking',
                'Elephant safari experiences',
                'Rapti River canoeing',
                'Tharu cultural performances',
                'Over 500 bird species',
                'Jungle walks and nature tours'
            ],
            'activities' => [
                'Jungle safaris',
                'Elephant experiences',
                'Canoe trips',
                'Bird watching',
                'Nature walks',
                'Cultural village tours',
                'Wildlife photography'
            ],
            'location_coordinates' => '27.5291, 84.3542',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Drive from Kathmandu (5-6 hours) or fly to Bharatpur',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Chitwan National Park - Nepal Wildlife Safari & Rhino Spotting',
            'meta_description' => 'Experience Nepal\'s premier wildlife destination. See rhinos, tigers, and diverse wildlife in Chitwan National Park\'s jungle safaris.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Lumbini
        [
            'id' => 6,
            'name' => 'Lumbini',
            'slug' => 'lumbini',
            'description' => 'The birthplace of Lord Buddha, a sacred pilgrimage site with ancient ruins and peaceful monasteries.',
            'long_description' => 'Lumbini is one of the most sacred places for Buddhists worldwide, as the birthplace of Siddhartha Gautama, who later became the Buddha. This UNESCO World Heritage Site attracts pilgrims and visitors from around the globe who come to pay homage and experience the peaceful atmosphere of this holy site. The sacred garden contains the Maya Devi Temple marking the exact birthplace, ancient ruins dating back over 2,000 years, and the famous Ashoka Pillar erected by Emperor Ashoka in 249 BC. The modern monastic zone features beautiful monasteries built by different Buddhist nations.',
            'featured_image' => '/assets/images/Kathmandu_temple_architecture_df1e8ace.png',
            'category' => 'Pilgrimage & Spirituality',
            'region' => 'Western Terai',
            'altitude_range' => '150m',
            'best_time_to_visit' => 'October-March',
            'duration' => '1-3 days',
            'difficulty_level' => 'Easy',
            'highlights' => [
                'Maya Devi Temple (Buddha\'s birthplace)',
                'Ancient Ashoka Pillar',
                'Sacred Bodhi Tree',
                'International monasteries',
                'Peaceful meditation gardens',
                'Archaeological remains',
                'Lumbini Museum'
            ],
            'activities' => [
                'Pilgrimage tours',
                'Meditation and reflection',
                'Monastery visits',
                'Archaeological exploration',
                'Spiritual ceremonies',
                'Cultural learning',
                'Photography'
            ],
            'location_coordinates' => '27.4833, 83.2753',
            'entry_permits_required' => false,
            'accommodation_available' => true,
            'transportation_info' => 'Drive from Kathmandu (8-9 hours) or fly to Bhairahawa (45 min drive to Lumbini)',
            'featured' => true,
            'published' => true,
            'meta_title' => 'Lumbini - Buddha\'s Birthplace | Sacred Buddhist Pilgrimage Site',
            'meta_description' => 'Visit sacred Lumbini, the birthplace of Lord Buddha. Explore ancient temples, monasteries, and experience spiritual tranquility.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Annapurna Base Camp Trek
        [
            'id' => 7,
            'name' => 'Annapurna Base Camp Trek',
            'slug' => 'annapurna-base-camp-trek',
            'description' => 'A spectacular trek to the heart of the Annapurna Sanctuary, surrounded by towering peaks.',
            'long_description' => 'The Annapurna Base Camp Trek, also known as the Annapurna Sanctuary Trek, is one of Nepal\'s most popular and accessible high-altitude treks. This remarkable journey takes you into a natural amphitheater surrounded by some of the world\'s highest peaks including Annapurna I (8,091m), Machapuchare (6,993m), and Hiunchuli. The trek passes through diverse landscapes from terraced hillsides and rhododendron forests to high alpine terrain. Experience warm Gurung hospitality in traditional villages and witness spectacular sunrise views over the Annapurna range from the base camp.',
            'featured_image' => '/assets/images/Prayer_flags_mountain_vista_1f2256d5.png',
            'category' => 'Trekking',
            'region' => 'Annapurna Region',
            'altitude_range' => '1,070m - 4,130m',
            'best_time_to_visit' => 'March-May, September-November',
            'duration' => '10-14 days',
            'difficulty_level' => 'Moderate to Challenging',
            'highlights' => [
                'Annapurna Base Camp (4,130m)',
                '360-degree mountain panorama',
                'Machapuchare Base Camp',
                'Traditional Gurung villages',
                'Rhododendron forests',
                'Natural hot springs at Jhinu Danda'
            ],
            'activities' => [
                'High-altitude trekking',
                'Mountain photography',
                'Cultural village exploration',
                'Hot spring relaxation',
                'Sunrise viewing',
                'Wildlife spotting'
            ],
            'location_coordinates' => '28.5311, 83.8206',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Drive to Nayapul from Pokhara (1.5 hours), then trek',
            'featured' => false,
            'published' => true,
            'meta_title' => 'Annapurna Base Camp Trek - Heart of Annapurna Sanctuary',
            'meta_description' => 'Trek to Annapurna Base Camp through diverse landscapes. Experience 360-degree mountain views and Gurung culture.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Langtang Valley Trek
        [
            'id' => 8,
            'name' => 'Langtang Valley Trek',
            'slug' => 'langtang-valley-trek',
            'description' => 'The closest major trek to Kathmandu, offering pristine mountain scenery and Tibetan culture.',
            'long_description' => 'The Langtang Valley Trek is often called the "Valley of Glaciers" and offers some of Nepal\'s most spectacular mountain scenery closest to Kathmandu. This trek takes you through Langtang National Park, home to diverse wildlife including the elusive red panda and Himalayan black bear. Experience authentic Tibetan culture in traditional villages, visit ancient monasteries, and enjoy stunning views of Langtang Lirung, Gang Chhenpo, and other towering peaks. The valley was significantly affected by the 2015 earthquake but has shown remarkable resilience in rebuilding.',
            'featured_image' => '/assets/images/Prayer_flags_mountain_vista_1f2256d5.png',
            'category' => 'Trekking',
            'region' => 'Langtang Region',
            'altitude_range' => '1,470m - 4,984m',
            'best_time_to_visit' => 'March-May, September-November',
            'duration' => '8-12 days',
            'difficulty_level' => 'Moderate',
            'highlights' => [
                'Kyanjin Gompa monastery',
                'Langtang Lirung views',
                'Tibetan culture and traditions',
                'Cheese factory visits',
                'Tserko Ri viewpoint (4,984m)',
                'Wildlife in Langtang National Park'
            ],
            'activities' => [
                'Mountain trekking',
                'Monastery visits',
                'Cultural immersion',
                'Wildlife observation',
                'Photography',
                'Local cheese tasting'
            ],
            'location_coordinates' => '28.2167, 85.5500',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Drive to Syabrubesi from Kathmandu (7-8 hours), then trek',
            'featured' => false,
            'published' => true,
            'meta_title' => 'Langtang Valley Trek - Valley of Glaciers Near Kathmandu',
            'meta_description' => 'Explore the beautiful Langtang Valley, closest major trek to Kathmandu. Experience Tibetan culture and stunning mountain views.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Gokyo Lakes Trek
        [
            'id' => 9,
            'name' => 'Gokyo Lakes Trek',
            'slug' => 'gokyo-lakes-trek',
            'description' => 'Alternative route to Everest region featuring pristine high-altitude lakes and spectacular mountain views.',
            'long_description' => 'The Gokyo Lakes Trek offers an spectacular alternative to the traditional Everest Base Camp route, featuring the world\'s highest freshwater lake system. This trek takes you to the pristine turquoise lakes at 4,700-5,000 meters altitude, surrounded by towering peaks including Cho Oyu (8,201m), the world\'s sixth highest mountain. Climb Gokyo Ri (5,357m) for one of the best panoramic views in the Himalayas, including four 8,000-meter peaks: Everest, Lhotse, Makalu, and Cho Oyu. The trek offers a more peaceful alternative with fewer crowds while still providing incredible Himalayan experiences.',
            'featured_image' => '/assets/images/Everest_sunrise_panorama_20949daa.png',
            'category' => 'Trekking',
            'region' => 'Everest Region',
            'altitude_range' => '2,860m - 5,357m',
            'best_time_to_visit' => 'March-May, September-November',
            'duration' => '12-16 days',
            'difficulty_level' => 'Challenging',
            'highlights' => [
                'Six pristine Gokyo Lakes',
                'Gokyo Ri summit (5,357m)',
                'Views of four 8,000m peaks',
                'Ngozumpa Glacier exploration',
                'Sherpa culture and villages',
                'Less crowded than EBC route'
            ],
            'activities' => [
                'High-altitude trekking',
                'Lake exploration',
                'Peak climbing',
                'Glacier viewing',
                'Photography',
                'Cultural experiences'
            ],
            'location_coordinates' => '27.9600, 86.6900',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Fly to Lukla from Kathmandu, then trek via Namche Bazaar',
            'featured' => false,
            'published' => true,
            'meta_title' => 'Gokyo Lakes Trek - Pristine High-Altitude Lakes in Everest Region',
            'meta_description' => 'Discover the beautiful Gokyo Lakes trek, featuring turquoise high-altitude lakes and spectacular mountain views.',
            'created_at' => time(),
            'updated_at' => time()
        ],

        // Mustang (Upper Mustang)
        [
            'id' => 10,
            'name' => 'Upper Mustang',
            'slug' => 'upper-mustang',
            'description' => 'The forbidden kingdom with Tibetan culture, ancient caves, and desert-like landscapes.',
            'long_description' => 'Upper Mustang, often called the "Forbidden Kingdom," is a restricted area that was closed to foreigners until 1992. This mystical region offers a unique blend of Tibetan culture, ancient Buddhist monasteries, and dramatic desert-like landscapes that feel like stepping back in time. The walled city of Lo Manthang serves as the capital of this former Buddhist kingdom, with its 15th-century royal palace and ancient monasteries. The region features colorful rock formations, ancient caves, and traditional Tibetan architecture that has remained virtually unchanged for centuries.',
            'featured_image' => '/assets/images/Prayer_flags_mountain_vista_1f2256d5.png',
            'category' => 'Culture & Adventure',
            'region' => 'Mustang Region',
            'altitude_range' => '2,815m - 4,000m+',
            'best_time_to_visit' => 'March-November (rain shadow area)',
            'duration' => '10-14 days',
            'difficulty_level' => 'Moderate',
            'highlights' => [
                'Lo Manthang walled city',
                'Ancient royal palace',
                'Sky caves and monasteries',
                'Tibetan Buddhist culture',
                'Unique desert landscapes',
                'Traditional festivals'
            ],
            'activities' => [
                'Cultural exploration',
                'Monastery visits',
                'Cave exploration',
                'Photography',
                'Traditional ceremonies',
                'Desert trekking'
            ],
            'location_coordinates' => '29.1833, 83.9333',
            'entry_permits_required' => true,
            'accommodation_available' => true,
            'transportation_info' => 'Fly to Jomsom from Pokhara, then drive or trek to Lo Manthang',
            'featured' => false,
            'published' => true,
            'meta_title' => 'Upper Mustang - The Forbidden Kingdom | Tibetan Culture Trek',
            'meta_description' => 'Explore mysterious Upper Mustang, the forbidden kingdom with ancient Tibetan culture, desert landscapes, and historic monasteries.',
            'created_at' => time(),
            'updated_at' => time()
        ]
    ];
}

/**
 * Get featured destinations only
 * 
 * @param int $limit Optional limit for number of destinations
 * @return array Array of featured destinations
 */
function getFeaturedDestinations($limit = null) {
    $destinations = getStaticDestinationsData();
    $featured = array_filter($destinations, function($dest) {
        return $dest['featured'] === true;
    });
    
    if ($limit) {
        return array_slice($featured, 0, $limit);
    }
    
    return $featured;
}

/**
 * Get destinations by category
 * 
 * @param string $category Category to filter by
 * @return array Array of destinations in the specified category
 */
function getDestinationsByCategory($category) {
    $destinations = getStaticDestinationsData();
    return array_filter($destinations, function($dest) use ($category) {
        return strcasecmp($dest['category'], $category) === 0;
    });
}

/**
 * Get a single destination by slug
 * 
 * @param string $slug Destination slug
 * @return array|null Destination data or null if not found
 */
function getDestinationBySlug($slug) {
    $destinations = getStaticDestinationsData();
    foreach ($destinations as $destination) {
        if ($destination['slug'] === $slug) {
            return $destination;
        }
    }
    return null;
}

/**
 * Get destination categories with counts from static data
 * 
 * @return array Array of categories with destination counts
 */
function getStaticDestinationCategories() {
    $destinations = getStaticDestinationsData();
    $categories = [];
    
    foreach ($destinations as $destination) {
        $category = $destination['category'];
        if (!isset($categories[$category])) {
            $categories[$category] = [
                'name' => $category,
                'slug' => strtolower(str_replace([' ', '&'], ['-', 'and'], $category)),
                'count' => 0
            ];
        }
        $categories[$category]['count']++;
    }
    
    return array_values($categories);
}

/**
 * Search destinations by keyword
 * 
 * @param string $keyword Search keyword
 * @return array Array of matching destinations
 */
function searchDestinations($keyword) {
    $destinations = getStaticDestinationsData();
    $keyword = strtolower($keyword);
    
    return array_filter($destinations, function($dest) use ($keyword) {
        return (
            stripos($dest['name'], $keyword) !== false ||
            stripos($dest['description'], $keyword) !== false ||
            stripos($dest['category'], $keyword) !== false ||
            stripos($dest['region'], $keyword) !== false ||
            stripos(implode(' ', $dest['highlights']), $keyword) !== false ||
            stripos(implode(' ', $dest['activities']), $keyword) !== false
        );
    });
}
?>