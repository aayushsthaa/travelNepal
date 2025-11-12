<?php
$page_title = 'About travelNepal - Your Nepal Adventure Experts';
$page_description = 'Learn about travelNepal, your trusted guide to exploring the wonders of Nepal. We provide expert travel advice, cultural insights, and adventure planning for your Himalayan journey.';

ob_start();
?>

<!-- About Hero Section -->
<section class="relative h-96 md:h-[500px] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo SITE_URL; ?>/assets/images/Kathmandu_temple_architecture_df1e8ace.png"
             alt="Nepal Culture"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-hero-pattern"></div>
    </div>
    
    <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
        <div class="max-w-4xl mx-auto animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-display font-bold mb-6">
                About <span class="text-nepal-600">travelNepal</span>
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto font-light">
                Your trusted companion for discovering the extraordinary beauty and culture of Nepal.
            </p>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-6">
                    Our <span class="text-gradient">Story</span>
                </h2>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    Founded by passionate travelers and Nepal natives, travelNepal was born from a deep love for the Himalayas and a desire to share the authentic beauty of Nepal with the world.
                </p>
                <p class="text-lg text-mountain-600 mb-6 leading-relaxed">
                    We believe that travel is more than just visiting places—it's about connecting with cultures, challenging yourself, and creating memories that last a lifetime. Nepal offers all of this and more.
                </p>
                <p class="text-lg text-mountain-600 leading-relaxed">
                    From the towering peaks of the Himalayas to the ancient streets of Kathmandu, we're here to guide you through every step of your Nepalese adventure.
                </p>
            </div>
            <div class="animate-on-scroll">
                <img src="<?php echo SITE_URL; ?>/assets/images/Everest_sunrise_panorama_20949daa.png" 
                     alt="Nepal Mountains" 
                     class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="py-16 bg-mountain-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                Our <span class="text-gradient">Mission</span>
            </h2>
            <p class="text-lg text-mountain-600 max-w-3xl mx-auto">
                We're committed to making Nepal accessible to travelers while promoting sustainable and responsible tourism.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Expert Guidance -->
            <div class="text-center bg-white p-8 rounded-2xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-nepal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-compass text-2xl text-nepal-600"></i>
                </div>
                <h3 class="text-xl font-bold text-mountain-800 mb-4">Expert Guidance</h3>
                <p class="text-mountain-600">
                    Providing authentic, well-researched travel information from locals and experienced trekkers who know Nepal intimately.
                </p>
            </div>
            
            <!-- Sustainable Tourism -->
            <div class="text-center bg-white p-8 rounded-2xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-nepal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-leaf text-2xl text-nepal-600"></i>
                </div>
                <h3 class="text-xl font-bold text-mountain-800 mb-4">Sustainable Tourism</h3>
                <p class="text-mountain-600">
                    Promoting responsible travel practices that benefit local communities and preserve Nepal's natural beauty for future generations.
                </p>
            </div>
            
            <!-- Cultural Respect -->
            <div class="text-center bg-white p-8 rounded-2xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-nepal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-heart text-2xl text-nepal-600"></i>
                </div>
                <h3 class="text-xl font-bold text-mountain-800 mb-4">Cultural Respect</h3>
                <p class="text-mountain-600">
                    Fostering deep appreciation and understanding of Nepal's rich cultural heritage, traditions, and diverse communities.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- What We Offer Section -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                What We <span class="text-gradient">Offer</span>
            </h2>
            <p class="text-lg text-mountain-600 max-w-3xl mx-auto">
                Comprehensive resources to help you plan and experience the perfect Nepal adventure.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Travel Guides -->
            <div class="flex items-start space-x-4 p-6 bg-mountain-50 rounded-xl">
                <div class="w-12 h-12 bg-nepal-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-map text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-mountain-800 mb-3">Detailed Travel Guides</h3>
                    <p class="text-mountain-600">
                        In-depth guides covering trekking routes, cultural sites, practical tips, and insider knowledge to help you make the most of your journey.
                    </p>
                </div>
            </div>
            
            <!-- Cultural Insights -->
            <div class="flex items-start space-x-4 p-6 bg-mountain-50 rounded-xl">
                <div class="w-12 h-12 bg-nepal-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-gopuram text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-mountain-800 mb-3">Cultural Insights</h3>
                    <p class="text-mountain-600">
                        Deep dives into Nepal's rich history, traditions, festivals, and customs to enhance your cultural understanding and appreciation.
                    </p>
                </div>
            </div>
            
            <!-- Adventure Planning -->
            <div class="flex items-start space-x-4 p-6 bg-mountain-50 rounded-xl">
                <div class="w-12 h-12 bg-nepal-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-mountain text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-mountain-800 mb-3">Adventure Planning</h3>
                    <p class="text-mountain-600">
                        Expert advice on trekking preparation, gear recommendations, fitness tips, and safety guidelines for Himalayan adventures.
                    </p>
                </div>
            </div>
            
            <!-- Local Connections -->
            <div class="flex items-start space-x-4 p-6 bg-mountain-50 rounded-xl">
                <div class="w-12 h-12 bg-nepal-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-mountain-800 mb-3">Local Connections</h3>
                    <p class="text-mountain-600">
                        Recommendations for authentic experiences, local guides, and community-based tourism opportunities that support local economies.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Values Section -->
<section class="py-16 bg-gradient-to-r from-nepal-500 to-nepal-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold mb-8">
            Why Choose travelNepal?
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="text-center">
                <div class="text-4xl mb-4">🏔️</div>
                <h3 class="text-xl font-bold mb-2">Local Expertise</h3>
                <p class="opacity-90">Born from the mountains, raised by the culture</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-4">🌱</div>
                <h3 class="text-xl font-bold mb-2">Responsible Travel</h3>
                <p class="opacity-90">Protecting Nepal for future generations</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-4">❤️</div>
                <h3 class="text-xl font-bold mb-2">Authentic Experiences</h3>
                <p class="opacity-90">Real stories, genuine connections</p>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="<?php echo siteUrl('contact'); ?>" class="border-2 border-white hover:bg-white hover:text-nepal-600 font-semibold px-8 py-3 rounded-full transition-colors">
                <i class="fas fa-envelope mr-2"></i>
                Get in Touch
            </a>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include TEMPLATES_PATH . '/layout.php';
?>
