CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','editor') DEFAULT 'editor',
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    reset_token VARCHAR(255) NULL,
    reset_expires_at DATETIME NULL
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(160) NOT NULL UNIQUE,
    name VARCHAR(160) NOT NULL,
    category ENUM('smart-home','security','audio-video','business','installation') NOT NULL,
    short_description TEXT NOT NULL,
    description LONGTEXT NOT NULL,
    features TEXT NOT NULL,
    starting_price DECIMAL(10,2) NOT NULL,
    icon VARCHAR(255) DEFAULT '/assets/img/default-service.svg',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(160) NOT NULL UNIQUE,
    title VARCHAR(180) NOT NULL,
    excerpt TEXT NOT NULL,
    content LONGTEXT NOT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    email VARCHAR(160) NOT NULL,
    phone VARCHAR(60) NULL,
    service_slug VARCHAR(160) NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    status VARCHAR(40) NOT NULL DEFAULT 'new'
);

CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS settings (
    `key` VARCHAR(160) PRIMARY KEY,
    value TEXT NULL
);

INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES
('Builderest Admin', 'info@builderest.com', '$2y$10$4rZIQ0GZ4gUPz7v3n5QHB.1Q0YOq6T6riw37ht4p59sj2CCOrvjTm', 'admin', NOW(), NOW());

INSERT INTO services (slug, name, category, short_description, description, features, starting_price, icon) VALUES
('tv-mounting', 'TV Mounting', 'installation', 'Precision wall mounting for any display with cable concealment and calibration.', 'Our specialists mount displays to any surface, conceal cabling, configure devices, and calibrate for perfect viewing angles. Includes safety testing and post-install tune up.', 'Premium mounts included\nCable routing and concealment\nDevice calibration\nMulti-room coordination\nPost-install adjustments', 130.00, '/assets/img/default-service.svg'),
('security-cameras', 'Security Cameras', 'security', 'AI-enabled surveillance with remote access, analytics, and resilient storage.', 'Design and deploy multi-camera systems with encrypted streaming, mobile monitoring, and proactive alerts to protect every perimeter.', '4K and thermal camera options\nCloud and local storage redundancy\nAI motion detection\n24/7 monitoring ready\nCompliance documentation', 308.00, '/assets/img/default-service.svg'),
('projector-installation', 'Projector Installation', 'audio-video', 'Cinematic projection with acoustic planning and smart control integration.', 'Transform media rooms with pro-grade projection, acoustic treatments, and lighting scenes curated for immersive experiences.', 'Laser and lamp projector support\nAcoustic calibration\nLighting automation\nStreaming integration\nOn-site training', 380.00, '/assets/img/default-service.svg'),
('smart-lighting', 'Smart Lighting Automation', 'smart-home', 'Dynamic lighting scenes that adapt to schedules, presence, and daylight levels.', 'We craft architectural lighting that responds to presence, daylight, and mood. Integrates with voice assistants and mobile control for ultimate flexibility.', 'Architectural fixture compatibility\nDaylight harvesting\nVoice and app control\nEnergy optimization reports\nEmergency lighting modes', 420.00, '/assets/img/default-service.svg'),
('access-control', 'Access Control Systems', 'security', 'Badge, biometric, and mobile credentials unified into a single secure platform.', 'Protect facilities with multi-factor access, visitor management, and compliance reporting. Designed for businesses requiring granular permissions.', 'Biometric & mobile credentials\nVisitor kiosk integration\nAudit-ready reporting\nEmergency lockdown workflows\nDirectory sync automation', 650.00, '/assets/img/default-service.svg'),
('network-hardening', 'Network Hardening', 'business', 'Resilient network architecture with zero-trust principles and proactive monitoring.', 'Engineer wired and wireless networks that withstand demanding loads. Includes segmentation, redundancy, and 24/7 monitoring.', 'Zero-trust segmentation\nSD-WAN deployment\nRedundant uplinks\nContinuous monitoring\nIncident response playbooks', 890.00, '/assets/img/default-service.svg'),
('home-theater', 'Home Theater Design', 'audio-video', 'Custom cinematic experiences with immersive audio, seating, and control.', 'Complete design-build service covering acoustic modeling, equipment selection, seating layouts, and automation scenes.', '3D acoustic modeling\nPremium audio calibration\nLighting & shade control\nVoice + app automation\nConcierge maintenance plans', 980.00, '/assets/img/default-service.svg'),
('smart-shades', 'Motorized Shades', 'smart-home', 'Automated shades tailored to architecture with climate-aware control.', 'Custom-fit motorized shading integrated with lighting and HVAC scheduling for comfort and efficiency.', 'Custom fabrics & hardware\nVoice and schedule control\nEnergy efficiency analytics\nIntegration with lighting scenes\nQuiet motor technology', 560.00, '/assets/img/default-service.svg'),
('firewall-management', 'Managed Firewall', 'business', 'Enterprise firewall deployment with continuous policy tuning and reporting.', 'Deploy and manage next-gen firewalls with intrusion prevention, reporting, and change control documentation.', 'Next-gen firewall licensing\n24/7 monitoring\nQuarterly policy reviews\nCompliance-ready reporting\nDisaster recovery planning', 720.00, '/assets/img/default-service.svg'),
('conference-rooms', 'Conference Room AV', 'business', 'Unified collaboration spaces with one-touch start and reliable connectivity.', 'Design conference rooms optimized for hybrid collaboration, featuring high-fidelity audio, intuitive control, and resilient connectivity.', 'Multi-platform conferencing\nAcoustic treatment\nTouch control interfaces\nNetwork QoS tuning\nUser onboarding sessions', 640.00, '/assets/img/default-service.svg'),
('smart-irrigation', 'Smart Irrigation', 'smart-home', 'Weather-aware irrigation protecting landscaping while conserving water.', 'Install sensors and smart controllers that respond to microclimates, ensuring landscapes thrive with minimal waste.', 'Zone-based scheduling\nWeather API integration\nRemote monitoring app\nLeak detection alerts\nAnalytics dashboard', 310.00, '/assets/img/default-service.svg'),
('enterprise-monitoring', 'Enterprise Monitoring', 'business', 'Full-stack monitoring with executive dashboards and automated escalations.', 'Build monitoring suites for servers, endpoints, and IoT devices with intelligent alerting and capacity forecasting.', 'Unified observability dashboards\nAutomated escalation matrix\nCapacity planning insights\nCustom executive reports\nSecurity event correlation', 940.00, '/assets/img/default-service.svg');

INSERT INTO posts (slug, title, excerpt, content, thumbnail, created_at, updated_at) VALUES
('zero-trust-playbook', 'Zero-Trust Playbook for Modern Businesses', 'How to evolve network security beyond the perimeter with Builderest methodology.', 'Zero-trust architecture demands visibility, segmentation, and relentless validation. Our engineers outline a phased roadmap to achieve measurable resilience.\n\n1. Map user journeys and data flows.\n2. Implement identity-driven segmentation.\n3. Automate monitoring and response.\n\nBuilderest partners with your teams to orchestrate the transformation and deliver ongoing governance.', NULL, NOW(), NOW()),
('smart-hospitality', 'Designing Hospitality Spaces with Smart Automation', 'Deliver hospitality experiences that impress guests while improving operations.', 'Hospitality brands leverage automation to orchestrate lighting, climate, audio, and guest services in harmony. We detail how Builderest designs scalable deployments using secure cloud control, predictive maintenance, and staff training.', NULL, NOW(), NOW()),
('next-gen-automation', 'Next-Gen Automation Trends to Watch', 'Five trends shaping smart environments across residential and commercial sectors.', 'Automation is moving beyond convenience into strategic infrastructure. Discover how edge AI, sustainable power, and interoperable ecosystems empower the next wave of projects.', NULL, NOW(), NOW());

INSERT INTO faqs (question, answer, created_at) VALUES
('How fast can Builderest deploy a new system?', 'Most residential projects complete in under two weeks once site surveys are complete. Commercial engagements follow a phased rollout to maintain uptime.', NOW()),
('Do you offer 24/7 monitoring?', 'Yes. Our support desk and network operations center are staffed around the clock for monitoring, maintenance, and emergency dispatch.', NOW()),
('What regions do you service?', 'Builderest operates across North America with global consulting available for enterprise rollouts.', NOW()),
('Can you integrate with existing equipment?', 'Absolutely. We audit current infrastructure and reuse viable components to maximize ROI while upgrading the experience.', NOW()),
('How are projects priced?', 'We provide fixed-scope proposals after discovery. Pricing is transparent and aligned with the service catalog published on builderest.com/pricing.', NOW());

INSERT INTO settings (`key`, value) VALUES
('hero_title', 'Secure. Automate. Simplify.'),
('hero_subtitle', 'Builderest engineers next-generation smart environments for homes and businesses.'),
('contact_phone', '+1 (855) 555-0184'),
('contact_email', 'info@builderest.com'),
('contact_address', 'Global Command Center, Remote First'),
('social_facebook', 'https://facebook.com/builderest'),
('social_instagram', 'https://instagram.com/builderest'),
('social_tiktok', 'https://tiktok.com/@builderest'),
('social_youtube', 'https://youtube.com/@builderest');
