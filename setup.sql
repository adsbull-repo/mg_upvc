-- ═══════════════════════════════════════════════
--  MG Windows & Doors — Database Setup
--  Run this ONCE in cPanel → phpMyAdmin
-- ═══════════════════════════════════════════════

-- 1. Create the blogs table
CREATE TABLE IF NOT EXISTS `blogs` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `title`      VARCHAR(255) NOT NULL,
  `slug`       VARCHAR(255) NOT NULL DEFAULT '',
  `excerpt`    VARCHAR(500) NOT NULL DEFAULT '',
  `content`    LONGTEXT     NOT NULL,
  `image`      VARCHAR(500) NOT NULL DEFAULT '',
  `tag`        VARCHAR(100) NOT NULL DEFAULT 'General',
  `read_time`  VARCHAR(30)  NOT NULL DEFAULT '3 min read',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Create admin_users table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `username`   VARCHAR(100) NOT NULL,
  `password`   VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Insert default admin  (username: admin / password: Admin@123)
--    Password is SHA-256 hashed. Change it after first login.
INSERT INTO `admin_users` (`username`, `password`) VALUES
('mgwindows11@gmail.com', SHA2('MGwindows@2026', 256));

-- 4. Seed the 6 existing static blog posts so they appear immediately
INSERT INTO `blogs` (`title`, `slug`, `excerpt`, `content`, `image`, `tag`, `read_time`, `created_at`) VALUES

('uPVC vs Aluminium Windows: Which Is Better for Your Home?',
 'upvc-vs-aluminium-windows',
 'Choosing between uPVC and aluminium? We break down key differences in durability, energy efficiency, aesthetics, maintenance, and cost.',
 '<p>When renovating or building a home, one of the most common questions homeowners ask us at MG Windows &amp; Doors is: <strong>Should I go for uPVC windows or aluminium windows?</strong> Both are excellent choices that far outperform traditional wood — but they serve different needs.</p><h2>Durability &amp; Strength</h2><p>Aluminium is inherently stronger than uPVC, making it the preferred choice for large window openings, floor-to-ceiling glazing, and commercial buildings. uPVC, while lighter, is still highly durable for standard residential applications.</p><h2>Energy Efficiency</h2><p>uPVC has a clear edge here. uPVC is a poor conductor of heat, meaning it naturally keeps heat out in summer. Modern aluminium windows with a thermal break close this gap significantly.</p><h2>Final Verdict</h2><p><strong>Choose uPVC</strong> for best thermal insulation and cost-effectiveness. <strong>Choose Aluminium</strong> for sleek modern aesthetics and large glass openings.</p>',
 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80&fit=crop&auto=format',
 'Guide', '5 min read', '2026-04-22 08:00:00'),

('5 Reasons Why uPVC Windows Are Perfect for South India''s Climate',
 'upvc-windows-south-india-climate',
 'Hot summers, heavy monsoons, and coastal humidity — learn how uPVC windows handle South India''s extreme weather better than wood or aluminium.',
 '<p>South India presents one of the toughest climates for windows and doors — intense heat, heavy monsoon rains, and high coastal humidity. uPVC windows are uniquely engineered to handle all of these challenges.</p><h2>1. Superior Heat Resistance</h2><p>uPVC frames do not conduct heat, keeping interiors cooler during harsh Tamil Nadu summers and reducing air conditioning costs.</p><h2>2. Monsoon-Proof</h2><p>uPVC is completely waterproof and will not swell, warp, or rot — no matter how heavy the monsoon rains get.</p><h2>3. Anti-Corrosion in Coastal Areas</h2><p>Salt-laden sea air destroys metal windows over time. uPVC is completely immune to salt corrosion, making it ideal for coastal cities.</p><h2>4. Low Maintenance</h2><p>Unlike wood, uPVC requires no painting, varnishing, or polishing. A simple wipe-down keeps it looking new for decades.</p><h2>5. Noise Reduction</h2><p>Multi-chamber uPVC profiles with double glazing dramatically reduce outside noise — a big advantage in busy South Indian cities.</p>',
 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80&fit=crop&auto=format',
 'Tips', '4 min read', '2026-04-22 08:10:00'),

('How to Maintain Your uPVC & Aluminium Windows for Maximum Lifespan',
 'window-maintenance-tips',
 'Simple, practical tips to keep your windows and doors looking brand new and functioning smoothly for decades.',
 '<p>Both uPVC and aluminium windows are low-maintenance by design, but a little care goes a long way in extending their lifespan and keeping them looking pristine.</p><h2>Cleaning the Frames</h2><p>Use a mild soap solution with a soft cloth. Avoid abrasive cleaners or scouring pads which can scratch the surface. Rinse with clean water and dry with a lint-free cloth.</p><h2>Lubricating the Hardware</h2><p>Apply a thin layer of silicone spray to hinges, handles, and locking mechanisms once or twice a year. Never use oil-based lubricants — they attract dust and grime.</p><h2>Checking the Seals</h2><p>Inspect rubber seals and gaskets annually. If you notice any gaps or hardening, have them replaced to maintain weatherproofing and energy efficiency.</p><h2>Cleaning the Tracks</h2><p>For sliding windows and doors, keep the tracks free of dust and debris. Use a vacuum and a small brush, then apply silicone spray to help the panels slide smoothly.</p>',
 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&q=80&fit=crop&auto=format',
 'Maintenance', '3 min read', '2026-04-22 08:20:00'),

('Bay Windows: How to Add Character and Space to Your Home',
 'bay-windows-design',
 'Bay windows are one of the most elegant architectural features. Discover how they improve aesthetics, add usable floor space, and flood rooms with natural light.',
 '<p>Bay windows project outward from the main walls of your home, creating a beautiful architectural focal point while providing practical benefits like increased floor space and enhanced natural light.</p><h2>Types of Bay Windows</h2><p>The three most popular configurations are the <strong>Box Bay</strong> (square projection), the <strong>Angled Bay</strong> (two side panels at 45° angles), and the <strong>Bow Bay</strong> (a curved arc of multiple panels).</p><h2>Benefits of Bay Windows</h2><p>Bay windows increase the apparent size of a room by pushing the outer wall forward. The extra floor space can become a cozy reading nook, a breakfast area, or simply extra seating. The multiple glass panels also allow light to enter from different angles throughout the day.</p><h2>Materials for Indian Homes</h2><p>For Indian climates, we recommend uPVC bay windows for residential use — they offer excellent thermal insulation and require no maintenance. For commercial and premium residential projects, aluminium bay windows provide sleeker profiles and greater structural span.</p>',
 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80&fit=crop&auto=format',
 'Design', '4 min read', '2026-04-22 08:30:00'),

('Fiber Doors vs Wooden Doors: The Smart Choice for Modern Indian Homes',
 'fiber-vs-wooden-doors',
 'Traditional wooden doors have charm, but fiber doors beat them on almost every practical metric. We compare waterproofing, termite resistance, maintenance, and value.',
 '<p>Wooden doors have been the default choice for Indian homes for generations. But modern fiber (FRP) doors have changed the equation dramatically — offering better performance at a comparable or lower price.</p><h2>Waterproofing</h2><p>Fiber doors are completely waterproof — they will never swell, warp, or delaminate even in the wettest monsoon conditions. Wooden doors, especially flush doors, frequently swell and jam during the rainy season.</p><h2>Termite &amp; Pest Resistance</h2><p>This is perhaps the biggest advantage of fiber doors. Termites destroy wooden doors from the inside out — often invisibly until serious damage is done. Fiber doors are completely immune to termite and pest attack.</p><h2>Maintenance</h2><p>Wooden doors need regular painting or varnishing every 2–3 years. Fiber doors need nothing — just occasional cleaning with a damp cloth.</p><h2>Cost Over Time</h2><p>While a solid teak door may cost more upfront, the ongoing maintenance of wooden doors makes them more expensive over a 10-year period. Fiber doors are virtually maintenance-free.</p>',
 'fibervswoord.png',
 'Comparison', '5 min read', '2026-04-22 08:40:00'),

('Aluminium Partition Doors: Transform Your Office Space in Coimbatore',
 'aluminium-partition-doors-office',
 'Modern office design relies on flexible, elegant partitioning. Learn how aluminium partition doors create productive workspaces while maintaining an open, bright atmosphere.',
 '<p>The modern workplace has moved away from closed, box-like offices toward open, flexible environments. Aluminium partition doors and walls are central to this transformation.</p><h2>Why Aluminium for Office Partitions?</h2><p>Aluminium''s strength-to-weight ratio allows for very slim profiles, maximising the glass area and maintaining an open, light-filled feel. Unlike drywall partitions, aluminium partitions can be easily reconfigured as your office layout needs change.</p><h2>Glass Options</h2><p>You can choose from clear glass (maximum openness), frosted glass (privacy while maintaining light), switchable smart glass (changes from clear to opaque at the touch of a button), or acoustic glass (for boardrooms and focus areas).</p><h2>Sliding vs. Swing Partition Doors</h2><p>Sliding aluminium doors are ideal for partitions where space is limited — they require no swing clearance. Swing doors work well for formal entrances and boardrooms. We also offer bifold and stacking options for large open-plan spaces.</p>',
 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80&fit=crop&auto=format',
 'Commercial', '4 min read', '2026-04-22 08:50:00');
