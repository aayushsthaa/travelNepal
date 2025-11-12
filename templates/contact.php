<?php
$page_title = 'Contact Us - Plan Your Nepal Adventure';
$page_description = 'Get in touch with travelNepal for personalized travel advice, trip planning assistance, and expert guidance for your Nepal adventure. We\'re here to help make your Himalayan dreams come true.';

ob_start();
?>

<!-- Contact Hero Section -->
<section class="relative h-96 md:h-[500px] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="<?php echo SITE_URL; ?>/assets/images/Pokhara_lake_reflections_ada62be7.png"
             alt="Pokhara Lake"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-hero-pattern"></div>
    </div>
    
    <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
        <div class="max-w-4xl mx-auto animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-display font-bold mb-6">
                Contact <span class="text-nepal-600">Us</span>
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto font-light">
                Ready to start your Nepal adventure? We're here to help you plan the perfect journey.
            </p>
        </div>
    </div>
</section>

<!-- Contact Content Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 animate-on-scroll">
            <!-- Contact Information -->
            <div class="bg-white p-8 rounded-2xl shadow-lg animate-on-scroll">
                <h2 class="text-3xl font-display font-bold text-mountain-800 mb-8">
                    Get in <span class="text-gradient">Touch</span>
                </h2>
                
                <div class="space-y-6 mb-8">
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-nepal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-nepal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-mountain-800 mb-1">Email Us</h3>
                            <p class="text-mountain-600 mb-2">Get personalized travel advice and planning assistance</p>
                            <a href="mailto:hello@travelnepal.com" class="text-nepal-600 hover:text-nepal-700 font-medium">
                                hello@travelnepal.com
                            </a>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-nepal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-nepal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-mountain-800 mb-1">Call Us</h3>
                            <p class="text-mountain-600 mb-2">Speak directly with our Nepal travel experts</p>
                            <a href="tel:+97714123456" class="text-nepal-600 hover:text-nepal-700 font-medium">
                                +977-1-4123456
                            </a>
                        </div>
                    </div>
                    
                    <!-- Office Location -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-nepal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-nepal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-mountain-800 mb-1">Visit Us</h3>
                            <p class="text-mountain-600 mb-2">Meet our team in the heart of Kathmandu</p>
                            <p class="text-mountain-700">
                                Thamel, Kathmandu<br>
                                Nepal 44600
                            </p>
                        </div>
                    </div>
                    
                    <!-- Response Time -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-nepal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-nepal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-mountain-800 mb-1">Response Time</h3>
                            <p class="text-mountain-600">We typically respond within 24 hours</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="border-t border-mountain-200 pt-6">
                    <h3 class="text-lg font-semibold text-mountain-800 mb-4">Follow Our Journey</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-500 text-white rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <h2 class="text-3xl font-display font-bold text-mountain-800 mb-8">
                    Send Us a <span class="text-gradient">Message</span>
                </h2>
                
                <form class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-mountain-700 mb-2">
                            Full Name *
                        </label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-mountain-700 mb-2">
                            Email Address *
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors">
                    </div>
                    
                    <!-- Travel Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="travel-date" class="block text-sm font-medium text-mountain-700 mb-2">
                                Preferred Travel Date
                            </label>
                            <input type="date" id="travel-date" name="travel_date"
                                   class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors">
                        </div>
                        <div>
                            <label for="duration" class="block text-sm font-medium text-mountain-700 mb-2">
                                Trip Duration
                            </label>
                            <select id="duration" name="duration"
                                    class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors">
                                <option value="">Select duration</option>
                                <option value="1-3 days">1-3 days</option>
                                <option value="4-7 days">4-7 days</option>
                                <option value="1-2 weeks">1-2 weeks</option>
                                <option value="2-3 weeks">2-3 weeks</option>
                                <option value="1 month+">1 month+</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Interest -->
                    <div>
                        <label for="interests" class="block text-sm font-medium text-mountain-700 mb-2">
                            What interests you most?
                        </label>
                        <select id="interests" name="interests"
                                class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors">
                            <option value="">Select your main interest</option>
                            <option value="trekking">Trekking & Hiking</option>
                            <option value="culture">Cultural Tours</option>
                            <option value="adventure">Adventure Sports</option>
                            <option value="wildlife">Wildlife & Nature</option>
                            <option value="spiritual">Spiritual Journey</option>
                            <option value="photography">Photography Tour</option>
                            <option value="custom">Custom Trip</option>
                        </select>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-mountain-700 mb-2">
                            Tell us about your dream Nepal trip *
                        </label>
                        <textarea id="message" name="message" rows="5" required
                                  placeholder="Share your travel goals, interests, experience level, group size, budget considerations, or any specific questions you have about visiting Nepal..."
                                  class="w-full px-4 py-3 border border-mountain-300 rounded-lg focus:ring-2 focus:ring-nepal-500 focus:border-nepal-500 transition-colors resize-none"></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-nepal-500 to-nepal-600 hover:from-nepal-600 hover:to-nepal-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
                
                <p class="text-sm text-mountain-600 mt-4 text-center">
                    * Required fields. We respect your privacy and will never share your information.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Location Map Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                Discover <span class="text-gradient">Nepal</span>
            </h2>
            <p class="text-lg text-mountain-600 max-w-3xl mx-auto">
                Nestled in the heart of the Himalayas between China and India, Nepal offers breathtaking landscapes,
                rich culture, and unforgettable adventures. Explore our beautiful country and start planning your journey.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 animate-on-scroll">
            <div class="mb-6">
                <h3 class="text-2xl font-display font-bold text-mountain-800 mb-2">
                    Nepal Location Map
                </h3>
                <p class="text-mountain-600">
                    Nepal is a landlocked country in South Asia, home to Mount Everest and rich cultural heritage. 
                    Our team is based in Kathmandu, the vibrant capital city.
                </p>
            </div>
            
            <!-- Interactive Map Container -->
            <div class="relative">
                <div id="nepal-map" class="w-full h-96 md:h-[500px] rounded-xl overflow-hidden border border-mountain-200"></div>
                
                <!-- Map Loading State -->
                <div id="map-loading" class="absolute inset-0 bg-mountain-50 rounded-xl flex items-center justify-center">
                    <div class="text-center">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-nepal-500 mb-3"></div>
                        <p class="text-mountain-600">Loading Nepal map...</p>
                    </div>
                </div>
            </div>
            
            <!-- Map Features -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-nepal-50 rounded-lg">
                    <i class="fas fa-mountain text-nepal-600 text-2xl mb-2"></i>
                    <h4 class="font-semibold text-mountain-800">Himalayan Views</h4>
                    <p class="text-sm text-mountain-600">Home to 8 of the world's 14 highest peaks</p>
                </div>
                <div class="text-center p-4 bg-nepal-50 rounded-lg">
                    <i class="fas fa-gopuram text-nepal-600 text-2xl mb-2"></i>
                    <h4 class="font-semibold text-mountain-800">Rich Culture</h4>
                    <p class="text-sm text-mountain-600">Ancient temples and diverse traditions</p>
                </div>
                <div class="text-center p-4 bg-nepal-50 rounded-lg">
                    <i class="fas fa-hiking text-nepal-600 text-2xl mb-2"></i>
                    <h4 class="font-semibold text-mountain-800">Adventure Hub</h4>
                    <p class="text-sm text-mountain-600">World-class trekking and outdoor activities</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-mountain-800 mb-4">
                Frequently Asked <span class="text-gradient">Questions</span>
            </h2>
            <p class="text-lg text-mountain-600">
                Quick answers to common questions about traveling to Nepal.
            </p>
        </div>

        <div class="space-y-6 animate-on-scroll">
            <!-- FAQ Item 1 -->
            <div class="bg-mountain-50 rounded-lg p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-mountain-800 mb-3">
                    <i class="fas fa-question-circle text-nepal-500 mr-2"></i>
                    When is the best time to visit Nepal?
                </h3>
                <p class="text-mountain-600">
                    The best times are during the pre-monsoon season (March-May) and post-monsoon season (September-November). These periods offer clear mountain views, stable weather, and comfortable temperatures for trekking.
                </p>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="bg-mountain-50 rounded-lg p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-mountain-800 mb-3">
                    <i class="fas fa-question-circle text-nepal-500 mr-2"></i>
                    Do I need a visa to visit Nepal?
                </h3>
                <p class="text-mountain-600">
                    Most visitors can obtain a visa on arrival at Kathmandu airport or apply online in advance. Requirements vary by nationality, so we recommend checking current visa requirements before your trip.
                </p>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-mountain-50 rounded-lg p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-mountain-800 mb-3">
                    <i class="fas fa-question-circle text-nepal-500 mr-2"></i>
                    What level of fitness is required for trekking?
                </h3>
                <p class="text-mountain-600">
                    Fitness requirements vary by trek. Short cultural walks require basic fitness, while high-altitude treks like Everest Base Camp need good cardiovascular fitness and preparation. We provide detailed fitness guidelines for each trek.
                </p>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-mountain-50 rounded-lg p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-mountain-800 mb-3">
                    <i class="fas fa-question-circle text-nepal-500 mr-2"></i>
                    How far in advance should I plan my trip?
                </h3>
                <p class="text-mountain-600">
                    We recommend booking major treks and accommodations 2-6 months in advance, especially during peak seasons. Last-minute trips are possible but may have limited options.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <p class="text-mountain-600 mb-4">Don't see your question answered?</p>
            <a href="#" class="text-nepal-600 hover:text-nepal-700 font-semibold">
                Send us a message and we'll help you out!
            </a>
        </div>
    </div>
</section>

<script>
// Initialize Nepal Map when page loads
document.addEventListener('DOMContentLoaded', function() {
    const mapLoading = document.getElementById('map-loading');
    const mapContainer = document.getElementById('nepal-map');
    
    // Check if Leaflet library is available
    if (window.L && typeof L.map === 'function') {
        // Initialize map centered on Nepal
        const map = L.map('nepal-map', {
            center: [28.3949, 84.1240], // Nepal coordinates
            zoom: 7, // Show whole country
            zoomControl: true,
            scrollWheelZoom: true,
            dragging: true,
            touchZoom: true,
            doubleClickZoom: true
        });
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);
        
        // Custom icon for Nepal marker
        const nepalIcon = L.divIcon({
            className: 'custom-nepal-marker',
            html: '<div class="marker-pin"><i class="fas fa-map-marker-alt"></i></div>',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });
        
        // Add marker for Kathmandu (capital city)
        const kathmanduMarker = L.marker([27.7172, 85.3240], { icon: nepalIcon })
            .addTo(map)
            .bindPopup(`
                <div class="map-popup">
                    <h4 class="font-bold text-mountain-800 mb-2">
                        <i class="fas fa-city text-nepal-500 mr-2"></i>Kathmandu, Nepal
                    </h4>
                    <p class="text-mountain-600 mb-2">Capital and largest city of Nepal</p>
                    <p class="text-sm text-mountain-500">Our team is located here to help plan your adventure!</p>
                </div>
            `, {
                maxWidth: 250,
                className: 'custom-popup'
            });
        
        // Hide loading indicator after map loads
        map.whenReady(function() {
            setTimeout(() => {
                mapLoading.style.display = 'none';
            }, 500);
        });
        
        // Make map responsive
        function resizeMap() {
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }
        
        // Handle window resize
        window.addEventListener('resize', resizeMap);
        
        // Optional: Add fullscreen control if available
        if (typeof L.control.fullscreen !== 'undefined') {
            map.addControl(new L.control.fullscreen());
        }
    } else {
        // Fallback when Leaflet library is not available
        const fallbackMessage = `
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-mountain-100 rounded-full mb-4">
                    <i class="fas fa-map text-mountain-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-mountain-800 mb-2">Map Temporarily Unavailable</h3>
                <p class="text-mountain-600 mb-4">
                    We're experiencing issues loading the interactive map. Please try refreshing the page.
                </p>
                <div class="text-sm text-mountain-500 space-y-1">
                    <p><strong>Nepal Location:</strong> South Asia, between China and India</p>
                    <p><strong>Capital:</strong> Kathmandu</p>
                    <p><strong>Coordinates:</strong> 28.3949°N, 84.1240°E</p>
                </div>
                <button onclick="location.reload()" 
                        class="mt-4 px-4 py-2 bg-nepal-500 text-white rounded-lg hover:bg-nepal-600 transition-colors">
                    <i class="fas fa-refresh mr-2"></i>Retry Loading Map
                </button>
            </div>
        `;
        
        mapContainer.innerHTML = fallbackMessage;
        mapLoading.style.display = 'none';
    }
});
</script>

<?php
$content = ob_get_clean();
include TEMPLATES_PATH . '/layout.php';
?>
