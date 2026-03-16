CREATE DATABASE IF NOT EXISTS webdevproject;
USE webdevproject;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(140) NOT NULL UNIQUE,
    category VARCHAR(40) NOT NULL,
    model_year INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    short_description VARCHAR(255) NOT NULL,
    full_description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    exterior_color VARCHAR(80) NOT NULL,
    interior_color VARCHAR(80) NOT NULL,
    engine VARCHAR(120) NOT NULL,
    horsepower INT NOT NULL,
    transmission VARCHAR(80) NOT NULL,
    drivetrain VARCHAR(80) NOT NULL,
    seats INT NOT NULL,
    featured TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    account_status ENUM('active', 'disabled') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value VARCHAR(255) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO products (
    name, slug, category, model_year, price, short_description, full_description,
    image_url, exterior_color, interior_color, engine, horsepower, transmission,
    drivetrain, seats, featured
) VALUES
('2026 Black Phantom Sedan', '2026-black-phantom-sedan', 'Sedan', 2026, 128500.00, 'Matte black finish, V12 engine, handcrafted interior.', 'A flagship luxury sedan combining a commanding matte-black presence with a handcrafted cabin and effortless long-distance comfort.', 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&w=900&q=80', 'Obsidian Black', 'Chestnut Leather', '6.0L Twin-Turbo V12', 563, '8-Speed Automatic', 'Rear-Wheel Drive', 5, 1),
('2026 Silver Ghost SUV', '2026-silver-ghost-suv', 'SUV', 2026, 119900.00, 'Premium grey, all-wheel drive, panoramic sunroof.', 'A premium SUV designed for confident travel with all-wheel traction, a panoramic roofline, and a tech-rich interior.', 'https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=900&q=80', 'Sterling Silver', 'Slate Leather', '4.4L Twin-Turbo V8', 523, '8-Speed Automatic', 'All-Wheel Drive', 7, 1),
('2026 White Lightning Coupe', '2026-white-lightning-coupe', 'Coupe', 2026, 137400.00, 'Pure white, carbon fiber body, sport-tuned suspension.', 'An expressive grand touring coupe with a lightweight carbon-fiber body, razor-sharp handling, and elegant interior finishes.', 'https://images.unsplash.com/photo-1461632830798-3adb3034e4c8?auto=format&fit=crop&w=900&q=80', 'Pearl White', 'Black Alcantara', '4.0L Twin-Turbo V8', 612, '7-Speed Dual Clutch', 'Rear-Wheel Drive', 4, 1),
('2026 Midnight Reserve Sedan', '2026-midnight-reserve-sedan', 'Sedan', 2026, 116800.00, 'Executive comfort with adaptive suspension and navy leather trim.', 'Crafted for executive travel, this sedan delivers whisper-quiet performance, adaptive ride control, and deeply cushioned seating.', 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=900&q=80', 'Midnight Blue', 'Navy Leather', '3.0L Turbo Inline-6', 429, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Imperial Crest SUV', '2026-imperial-crest-suv', 'SUV', 2026, 131250.00, 'Three-row luxury SUV with captain seating and air suspension.', 'A refined family-focused luxury SUV offering spacious third-row seating, air suspension, and first-class rear comfort.', 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?auto=format&fit=crop&w=900&q=80', 'Graphite Grey', 'Sand Leather', '3.5L Twin-Turbo V6', 409, '10-Speed Automatic', 'All-Wheel Drive', 7, 0),
('2026 Horizon GT Coupe', '2026-horizon-gt-coupe', 'Coupe', 2026, 144900.00, 'Grand tourer with sculpted bodywork and twin-turbo power.', 'This grand tourer balances high-speed confidence with tailored cabin materials and a striking long-hood silhouette.', 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=900&q=80', 'Arctic Silver', 'Merlot Leather', '4.0L Twin-Turbo V8', 630, '8-Speed Automatic', 'Rear-Wheel Drive', 4, 0),
('2026 Sapphire Executive Sedan', '2026-sapphire-executive-sedan', 'Sedan', 2026, 109400.00, 'Elegant sedan with rear executive package and soft-close doors.', 'A luxury sedan tailored for business-class comfort, with rear lounge seating and a serene cabin atmosphere.', 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=900&q=80', 'Sapphire Blue', 'Ivory Leather', '3.0L Turbo Inline-6', 375, '8-Speed Automatic', 'Rear-Wheel Drive', 5, 0),
('2026 Arctic Crown SUV', '2026-arctic-crown-suv', 'SUV', 2026, 124700.00, 'Luxury utility with heated captain seats and terrain drive modes.', 'Built for year-round confidence, this upscale SUV pairs polished road manners with adaptable terrain systems.', 'https://images.unsplash.com/photo-1517524008697-84bbe3c3fd98?auto=format&fit=crop&w=900&q=80', 'Glacier White', 'Charcoal Leather', '3.0L Turbo Inline-6 Hybrid', 434, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Onyx Aero Coupe', '2026-onyx-aero-coupe', 'Coupe', 2026, 152300.00, 'Aerodynamic fastback coupe with ceramic brakes and launch control.', 'Precision-focused and dramatic, the Onyx Aero Coupe delivers thrilling acceleration with a beautifully minimalist cockpit.', 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=900&q=80', 'Onyx Black', 'Crimson Leather', '4.4L Twin-Turbo V8', 671, '8-Speed Automatic', 'All-Wheel Drive', 4, 0),
('2026 Regent Hybrid Sedan', '2026-regent-hybrid-sedan', 'Sedan', 2026, 98750.00, 'Efficiency-minded flagship with hybrid power and massage seating.', 'A smooth and intelligent hybrid sedan with a calm ride, premium audio, and eco-conscious luxury engineering.', 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=900&q=80', 'Quartz Silver', 'Pearl Beige', '2.5L Turbo Hybrid', 348, '8-Speed Automatic', 'Front-Wheel Drive', 5, 0),
('2026 Summit Signature SUV', '2026-summit-signature-suv', 'SUV', 2026, 138200.00, 'Flagship SUV with executive second row and premium tow package.', 'A commanding SUV that combines full-size comfort, luxury appointments, and advanced driver assistance for long-distance touring.', 'https://images.unsplash.com/photo-1498887960847-2a5e46312788?auto=format&fit=crop&w=900&q=80', 'Deep Navy', 'Cognac Leather', '3.5L Twin-Turbo V6', 440, '10-Speed Automatic', 'All-Wheel Drive', 7, 0),
('2026 Valencia Sport Coupe', '2026-valencia-sport-coupe', 'Coupe', 2026, 149800.00, 'Italian-inspired coupe with adaptive dampers and vivid styling.', 'This exotic-influenced coupe pairs sharp proportions with high-revving excitement and a driver-focused cockpit.', 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&w=900&q=80', 'Rosso Red', 'Black Leather', '3.9L Twin-Turbo V8', 641, '7-Speed Dual Clutch', 'Rear-Wheel Drive', 2, 0),
('2026 Grand Estate Sedan', '2026-grand-estate-sedan', 'Sedan', 2026, 112600.00, 'Long-wheelbase comfort with lounge seating and rear media screens.', 'Designed for chauffeur-level comfort, the Grand Estate Sedan blends generous cabin space with understated elegance.', 'https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=900&q=80', 'Champagne Silver', 'Mocha Leather', '3.0L Turbo Inline-6', 402, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Meridian Luxe SUV', '2026-meridian-luxe-suv', 'SUV', 2026, 127300.00, 'Luxury crossover with ventilated seating and immersive audio.', 'The Meridian Luxe SUV is tuned for comfort-first travel, with premium audio, a wide panoramic roof, and confident all-weather handling.', 'https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&w=900&q=80', 'Moonstone Grey', 'Ivory Leather', '3.0L Turbo Inline-6', 395, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Carbon Halo Coupe', '2026-carbon-halo-coupe', 'Coupe', 2026, 158900.00, 'High-performance coupe with active aero and carbon roof.', 'The Carbon Halo Coupe is purpose-built for exhilarating road presence, with active aerodynamics and track-ready composure.', 'https://images.unsplash.com/photo-1503736028674-451b2cb67b32?auto=format&fit=crop&w=900&q=80', 'Storm Grey', 'Black Alcantara', '5.2L Twin-Turbo V10', 710, '8-Speed Dual Clutch', 'All-Wheel Drive', 2, 0),
('2026 Heritage Line Sedan', '2026-heritage-line-sedan', 'Sedan', 2026, 102400.00, 'Classic-inspired styling with modern digital cockpit features.', 'A tasteful executive sedan with heritage design cues, polished wood trim, and intuitive technology integration.', 'https://images.unsplash.com/photo-1502161254066-6c74afbf07aa?auto=format&fit=crop&w=900&q=80', 'British Racing Green', 'Tan Leather', '2.9L Twin-Turbo V6', 362, '8-Speed Automatic', 'Rear-Wheel Drive', 5, 0),
('2026 Atlas Prestige SUV', '2026-atlas-prestige-suv', 'SUV', 2026, 133600.00, 'Prestige SUV with off-road package and executive cabin finishes.', 'A luxury SUV that blends elevated daily comfort with extra capability for destination travel beyond the city.', 'https://images.unsplash.com/photo-1514316454349-750a7fd3da3a?auto=format&fit=crop&w=900&q=80', 'Volcanic Black', 'Camel Leather', '4.0L Twin-Turbo V8', 577, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Riviera Grand Coupe', '2026-riviera-grand-coupe', 'Coupe', 2026, 146500.00, 'Ocean-inspired grand coupe with panoramic roof and silk-smooth ride.', 'Built for elegant coastal journeys, the Riviera Grand Coupe pairs sculpted design with refined touring comfort.', 'https://images.unsplash.com/photo-1489824904134-891ab64532f1?auto=format&fit=crop&w=900&q=80', 'Ocean Blue', 'Cream Leather', '4.0L Twin-Turbo V8', 591, '8-Speed Automatic', 'Rear-Wheel Drive', 4, 0),
('2026 Platinum Voyager Sedan', '2026-platinum-voyager-sedan', 'Sedan', 2026, 121900.00, 'Touring sedan with air suspension and rear comfort package.', 'A polished premium sedan focused on smooth highway travel, elegant materials, and full-day comfort.', 'https://images.unsplash.com/photo-1493238792000-8113da705763?auto=format&fit=crop&w=900&q=80', 'Platinum Silver', 'Espresso Leather', '3.0L Turbo Inline-6', 389, '8-Speed Automatic', 'All-Wheel Drive', 5, 0),
('2026 Northstar Elite SUV', '2026-northstar-elite-suv', 'SUV', 2026, 142750.00, 'Top-tier SUV with luxury seating, night vision, and concierge tech.', 'The Northstar Elite SUV offers flagship utility, advanced safety technology, and a deeply luxurious interior for every row.', 'https://images.unsplash.com/photo-1511391403284-6037f4c0f0b8?auto=format&fit=crop&w=900&q=80', 'Pearl White', 'Navy Leather', '4.4L Twin-Turbo V8', 611, '8-Speed Automatic', 'All-Wheel Drive', 7, 0);

INSERT INTO users (full_name, email, password_hash, role, account_status)
VALUES
('Site Administrator', 'admin@luxuryvehiclestore.com', '$2y$12$io4G3U.uWo34TbqBNUviWu0./BZCqC3B1tfeJJbushcfbsucztr4G', 'admin', 'active')
ON DUPLICATE KEY UPDATE
    full_name = VALUES(full_name),
    role = VALUES(role),
    account_status = VALUES(account_status);

INSERT INTO site_settings (setting_key, setting_value)
VALUES ('site_theme', 'theme-classic')
ON DUPLICATE KEY UPDATE
    setting_value = VALUES(setting_value);
