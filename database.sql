-- travelNepal MySQL Database Schema 
-- Converted from PostgreSQL for XAMPP deployment 
-- Date: 2025-09-25 
-- All image paths should use SITE_URL format 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE IF NOT EXISTS `post_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- Insert Categories
INSERT INTO `categories` (`name`, `slug`, `description`) VALUES
('Trekking', 'trekking', 'Explore Nepal\'s famous trekking routes from Everest Base Camp to Annapurna Circuit'),
('Cultural Tours', 'cultural-tours', 'Discover Nepal\'s rich cultural heritage, ancient temples, and traditional villages'),
('Adventure Sports', 'adventure-sports', 'Experience thrilling adventures like bungee jumping, paragliding, and white water rafting'),
('Wildlife & Safari', 'wildlife-safari', 'Wildlife adventures in Nepal\'s national parks including Chitwan and Bardia'),
('Mountain Climbing', 'mountain-climbing', 'Expedition and peak climbing adventures in the Himalayas'),
('Photography Tours', 'photography-tours', 'Specialized tours for photographers to capture Nepal\'s stunning landscapes and culture');

-- --------------------------------------------------------

-- Add default admin user (password: admin123)
INSERT INTO `users` (`username`, `password_hash`, `email`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com', 'admin');

-- --------------------------------------------------------

-- Insert Detailed Articles
INSERT INTO `posts` (`title`, `slug`, `excerpt`, `content`, `category`, `featured_image`, `published`, `author_id`) VALUES

('Ultimate Guide to Everest Base Camp Trek', 'ultimate-guide-everest-base-camp-trek', 'Complete guide to trekking to Everest Base Camp including preparation, costs, and what to expect on this life-changing adventure.', '<p>The Everest Base Camp Trek is one of the world\'s most iconic trekking experiences, taking you through the heart of the Khumbu region to the foot of the world\'s highest mountain. This comprehensive guide will help you plan and prepare for this incredible adventure.</p>

<h3>Overview</h3>
<p>The trek to Everest Base Camp typically takes 12-14 days, covering approximately 130 kilometers round trip. Starting from Lukla at 2,840 meters, you\'ll ascend to Everest Base Camp at 5,364 meters, passing through traditional Sherpa villages, ancient monasteries, and breathtaking Himalayan landscapes.</p>

<h3>Best Time to Visit</h3>
<p><strong>Spring (March-May):</strong> The most popular season with stable weather, clear skies, and blooming rhododendrons. Temperatures range from -10°C to 15°C.</p>
<p><strong>Autumn (September-November):</strong> Second most popular season with excellent visibility and stable weather. Temperatures range from -15°C to 10°C.</p>

<h3>Preparation and Fitness</h3>
<p>Physical preparation is crucial for this trek. Start training 2-3 months before your departure:</p>
<ul>
<li>Cardiovascular exercises (running, cycling, swimming)</li>
<li>Strength training for legs and core</li>
<li>Practice hiking with a loaded backpack</li>
<li>Altitude training if possible</li>
</ul>

<h3>Essential Gear</h3>
<p><strong>Clothing:</strong> Layering system with moisture-wicking base layers, insulating mid-layers, and waterproof outer shell.</p>
<p><strong>Footwear:</strong> Broken-in hiking boots with ankle support and warm socks.</p>
<p><strong>Equipment:</strong> Quality sleeping bag (-20°C rating), trekking poles, headlamp, water purification tablets.</p>

<h3>Accommodation and Food</h3>
<p>Teahouses provide basic but comfortable accommodation. Rooms are typically shared with basic facilities. Food options include traditional Nepali dal bhat, noodles, soups, and international dishes.</p>

<h3>Cost Breakdown</h3>
<p><strong>Budget:</strong> $1,200-1,500 USD per person for 14-day trek</p>
<p><strong>Standard:</strong> $1,800-2,500 USD per person</p>
<p><strong>Luxury:</strong> $3,000+ USD per person</p>

<h3>Safety and Altitude Sickness</h3>
<p>Altitude sickness is a serious concern. Key prevention strategies:</p>
<ul>
<li>Gradual ascent with acclimatization days</li>
<li>Stay hydrated (3-4 liters daily)</li>
<li>Listen to your body and descend if symptoms worsen</li>
<li>Travel with experienced guides</li>
</ul>

<h3>Cultural Etiquette</h3>
<p>Respect local customs and traditions. Always walk clockwise around stupas and mani walls, remove shoes when entering temples, and ask permission before photographing people.</p>', 'Trekking', 'assets/images/Everest_sunrise_panorama_20949daa.png', 1, 1),

('Discovering Kathmandu Valley: Cultural Heritage Tour', 'discovering-kathmandu-valley-cultural-heritage', 'Explore the ancient cities of Kathmandu Valley, home to UNESCO World Heritage Sites and centuries of Buddhist and Hindu culture.', '<p>The Kathmandu Valley is a treasure trove of cultural heritage, containing seven UNESCO World Heritage Sites within a 20-kilometer radius. This comprehensive guide takes you through the valley\'s most significant cultural and historical sites.</p>

<h3>Introduction to Kathmandu Valley</h3>
<p>The Kathmandu Valley consists of three ancient cities: Kathmandu, Patan, and Bhaktapur. Each city was once an independent kingdom with its own royal palace, temples, and unique culture. Today, they form the cultural heart of Nepal.</p>

<h3>Kathmandu Durbar Square</h3>
<p>The historic heart of Kathmandu, featuring:</p>
<ul>
<li><strong>Hanuman Dhoka Palace:</strong> Former royal residence with intricate wood carvings</li>
<li><strong>Kumari Ghar:</strong> Home of the living goddess Kumari</li>
<li><strong>Taleju Temple:</strong> 16th-century temple with stunning architecture</li>
<li><strong>Kasthamandap:</strong> Ancient wooden building that gave Kathmandu its name</li>
</ul>

<h3>Swayambhunath Stupa (Monkey Temple)</h3>
<p>This ancient stupa sits atop a hill overlooking the valley. The 365-step climb rewards visitors with panoramic views and encounters with the resident monkey population. Key features include the Buddha\'s eyes, prayer wheels, and numerous shrines.</p>

<h3>Pashupatinath Temple</h3>
<p>Nepal\'s most sacred Hindu temple dedicated to Lord Shiva. The temple complex includes:</p>
<ul>
<li>Main temple with golden roof and silver doors</li>
<li>Ghats (cremation platforms) along the Bagmati River</li>
<li>Sadhus (holy men) in meditation</li>
<li>Evening aarti (prayer ceremony)</li>
</ul>

<h3>Boudhanath Stupa</h3>
<p>One of the largest stupas in the world and the center of Tibetan Buddhism in Nepal. The stupa\'s massive mandala makes it a focal point for Tibetan culture and religion. Walk the kora (circumambulation) with pilgrims spinning prayer wheels.</p>

<h3>Patan Durbar Square</h3>
<p>The "City of Fine Arts" showcases exceptional Newari architecture:</p>
<ul>
<li><strong>Krishna Mandir:</strong> Stone temple with 21 golden pinnacles</li>
<li><strong>Hiranya Varna Mahavihar:</strong> Golden temple with bronze statues</li>
<li><strong>Mahabouddha Temple:</strong> Temple of a million Buddhas</li>
<li><strong>Patan Museum:</strong> Excellent collection of religious art</li>
</ul>

<h3>Bhaktapur Durbar Square</h3>
<p>The best-preserved medieval city in the valley:</p>
<ul>
<li><strong>55-Window Palace:</strong> Masterpiece of wood carving</li>
<li><strong>Vatsala Temple:</strong> Beautiful stone temple</li>
<li><strong>Nyatapola Temple:</strong> Five-story pagoda, Nepal\'s tallest</li>
<li><strong>Pottery Square:</strong> Traditional pottery making</li>
</ul>

<h3>Practical Information</h3>
<p><strong>Best Time to Visit:</strong> October to March for clear skies and comfortable temperatures.</p>
<p><strong>Getting Around:</strong> Taxis, local buses, or hire a private vehicle with driver.</p>
<p><strong>Entry Fees:</strong> Most sites charge 100-1000 NPR for foreigners.</p>
<p><strong>Duration:</strong> 2-3 days minimum, 5-7 days recommended for thorough exploration.</p>

<h3>Cultural Etiquette</h3>
<p>Respect local customs: remove shoes before entering temples, dress modestly, ask permission before photographing people, and walk clockwise around religious monuments.</p>', 'Cultural Tours', 'assets/images/Kathmandu_temple_architecture_df1e8ace.png', 1, 1),

('Chitwan National Park: Complete Wildlife Safari Guide', 'chitwan-national-park-complete-wildlife-safari-guide', 'Discover Nepal\'s first national park, home to Bengal tigers, one-horned rhinos, and incredible biodiversity in the subtropical lowlands.', '<p>Chitwan National Park, established in 1973, is Nepal\'s first national park and a UNESCO World Heritage Site. This 932-square-kilometer protected area in the subtropical lowlands of south-central Nepal offers some of the best wildlife viewing opportunities in Asia.</p>

<h3>Overview</h3>
<p>Chitwan means "Heart of the Jungle" in Nepali, and the park lives up to its name with diverse ecosystems including sal forests, grasslands, and riverine habitats. The park is home to over 700 species of wildlife, including 68 mammal species and 544 bird species.</p>

<h3>Major Wildlife Species</h3>
<p><strong>Bengal Tigers:</strong> Approximately 120-150 tigers roam the park. While sightings are rare due to their elusive nature, the park offers one of the best chances to spot these magnificent predators in Nepal.</p>
<p><strong>One-Horned Rhinoceros:</strong> Chitwan\'s flagship species with a population of over 600 individuals. These prehistoric-looking creatures are regularly seen during safaris.</p>
<p><strong>Asian Elephants:</strong> Both wild elephants and domesticated elephants used for safaris. Wild elephant sightings are common near water sources.</p>
<p><strong>Gaur (Indian Bison):</strong> The world\'s largest wild cattle species, often seen in grassland areas.</p>
<p><strong>Sloth Bears:</strong> Shaggy black bears that feed primarily on termites and fruits.</p>
<p><strong>Deer Species:</strong> Spotted deer (chital), sambar deer, barking deer, and hog deer are abundant.</p>
<p><strong>Crocodiles:</strong> Both mugger crocodiles and the rare gharial (fish-eating crocodile) inhabit the park\'s rivers.</p>

<h3>Safari Activities</h3>
<p><strong>Jeep Safari:</strong> The most popular option, covering larger areas of the park. Morning and afternoon safaris available, 3-4 hours duration.</p>
<p><strong>Elephant Safari:</strong> Traditional method allowing close encounters with wildlife, particularly rhinos. Usually 1-2 hours duration.</p>
<p><strong>Walking Safari:</strong> Guided walks with experienced naturalists, offering intimate wildlife experiences and bird watching opportunities.</p>
<p><strong>Canoe Trip:</strong> Traditional dugout canoe rides on the Rapti River, excellent for viewing aquatic birds, crocodiles, and riverbank wildlife.</p>
<p><strong>Nature Walk:</strong> Short walks around the buffer zone with naturalist guides.</p>

<h3>Bird Watching</h3>
<p>Chitwan is a birdwatcher\'s paradise with over 540 recorded species:</p>
<ul>
<li><strong>Endangered Species:</strong> Bengal florican, lesser adjutant stork, white-rumped vulture</li>
<li><strong>Water Birds:</strong> Various species of storks, herons, egrets, and kingfishers</li>
<li><strong>Raptors:</strong> Crested serpent eagle, changeable hawk-eagle, osprey</li>
<li><strong>Forest Birds:</strong> Hornbills, barbets, woodpeckers, and pheasants</li>
</ul>

<h3>Best Time to Visit</h3>
<p><strong>October to March:</strong> Cool, dry season with excellent wildlife viewing. Temperatures range from 10-25°C.</p>
<p><strong>February to April:</strong> Spring season with pleasant weather and active wildlife.</p>
<p><strong>May to September:</strong> Monsoon season with heavy rainfall, limited activities, but lush vegetation.</p>

<h3>Accommodation Options</h3>
<p><strong>Luxury Resorts:</strong> $200-500 USD per night with premium facilities and services.</p>
<p><strong>Standard Hotels:</strong> $50-150 USD per night with good facilities and safari packages.</p>
<p><strong>Budget Lodges:</strong> $20-50 USD per night with basic facilities.</p>
<p><strong>Community Homestays:</strong> $15-30 USD per night offering authentic local experiences.</p>

<h3>Getting There</h3>
<p><strong>From Kathmandu:</strong> 5-6 hour drive (160 km) or 20-minute flight to Bharatpur followed by 30-minute drive.</p>
<p><strong>From Pokhara:</strong> 4-5 hour drive (140 km) or 15-minute flight to Bharatpur.</p>

<h3>Safety Guidelines</h3>
<ul>
<li>Always stay with your guide during safaris</li>
<li>Maintain safe distance from wildlife</li>
<li>Do not feed animals</li>
<li>Follow park regulations and guide instructions</li>
<li>Carry insect repellent and wear neutral-colored clothing</li>
</ul>

<h3>Conservation Success</h3>
<p>Chitwan represents one of Asia\'s most successful conservation stories. The one-horned rhino population has increased from fewer than 100 individuals in the 1960s to over 600 today, while tiger numbers have also significantly recovered.</p>', 'Wildlife & Safari', 'assets/images/Pokhara_lake_reflections_ada62be7.png', 1, 1),

('Paragliding in Pokhara: Complete Adventure Guide', 'paragliding-pokhara-complete-adventure-guide', 'Experience the thrill of paragliding over Pokhara Valley with stunning views of the Annapurna range and Phewa Lake.', '<p>Pokhara, Nepal\'s adventure capital, offers one of the world\'s most spectacular paragliding experiences. Soar above the beautiful Pokhara Valley with panoramic views of the Annapurna mountain range, Phewa Lake, and traditional villages below.</p>

<h3>Why Pokhara for Paragliding?</h3>
<p>Pokhara\'s unique geography creates ideal paragliding conditions:</p>
<ul>
<li><strong>Thermal Conditions:</strong> Consistent thermals from the valley floor</li>
<li><strong>Stable Weather:</strong> Reliable flying conditions most of the year</li>
<li><strong>Stunning Scenery:</strong> Views of Annapurna range, Machhapuchhre, and Phewa Lake</li>
<li><strong>Safe Landing Zones:</strong> Large, clear landing areas near the lake</li>
<li><strong>Experienced Operators:</strong> Well-trained pilots with international certifications</li>
</ul>

<h3>Best Time for Paragliding</h3>
<p><strong>October to December:</strong> Clear skies, stable weather, and excellent visibility. Temperatures range from 15-25°C.</p>
<p><strong>February to April:</strong> Spring season with good thermals and clear mountain views.</p>
<p><strong>May to September:</strong> Monsoon season with limited flying opportunities due to rain and clouds.</p>

<h3>Flight Options</h3>
<p><strong>Discovery Flight (15-20 minutes):</strong> Perfect for first-timers, includes basic maneuvers and scenic views.</p>
<p><strong>Cross-Country Flight (30-45 minutes):</strong> Longer flight exploring thermals and covering more distance.</p>
<p><strong>Tandem Flight with Acrobatics (20-30 minutes):</strong> Includes thrilling maneuvers like wing-overs and spirals.</p>
<p><strong>Solo Training Courses:</strong> Multi-day courses for those wanting to learn paragliding.</p>

<h3>Take-off and Landing</h3>
<p><strong>Sarangkot Take-off:</strong> Located at 1,592 meters above sea level, offering spectacular launch conditions and immediate views of the Annapurna range.</p>
<p><strong>Phewa Lake Landing:</strong> Smooth landing zone near the lake shore, easily accessible from Pokhara town.</p>

<h3>Safety Standards</h3>
<p><strong>Pilot Certification:</strong> All tandem pilots hold international certifications from APPI, USHPA, or similar organizations.</p>
<p><strong>Equipment:</strong> Regular maintenance and inspection of all paragliding equipment.</p>
<p><strong>Weather Monitoring:</strong> Flights only operate in suitable weather conditions.</p>
<p><strong>Insurance:</strong> Comprehensive insurance coverage for all participants.</p>

<h3>What to Expect</h3>
<p><strong>Pre-flight:</strong> Safety briefing, equipment check, and weather assessment (30 minutes).</p>
<p><strong>Transportation:</strong> 30-minute drive to Sarangkot take-off point.</p>
<p><strong>Flight:</strong> 15-45 minutes in the air depending on chosen package.</p>
<p><strong>Post-flight:</strong> Certificate presentation and photo opportunities.</p>

<h3>What to Bring</h3>
<ul>
<li>Sunglasses and sunscreen</li>
<li>Comfortable clothing and closed shoes</li>
<li>Camera (optional, pilots can take photos)</li>
<li>Light jacket for cooler temperatures at altitude</li>
</ul>

<h3>Pricing</h3>
<p><strong>Discovery Flight:</strong> $80-100 USD</p>
<p><strong>Cross-Country Flight:</strong> $120-150 USD</p>
<p><strong>Acrobatic Flight:</strong> $100-130 USD</p>
<p><strong>Photo/Video Package:</strong> $20-30 USD additional</p>

<h3>Other Adventure Activities in Pokhara</h3>
<p>Combine your paragliding experience with:</p>
<ul>
<li><strong>Ultra-light Flights:</strong> Powered aircraft flights for mountain views</li>
<li><strong>Bungee Jumping:</strong> 70-meter jump over a tropical gorge</li>
<li><strong>Zip-lining:</strong> One of the world\'s steepest zip lines</li>
<li><strong>Mountain Biking:</strong> Trails around Pokhara valley</li>
<li><strong>Rock Climbing:</strong> Natural rock faces near the city</li>
</ul>', 'Adventure Sports', 'assets/images/Prayer_flags_mountain_vista_1f2256d5.png', 1, 1);

COMMIT;