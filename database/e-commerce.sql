-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2024 at 05:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Description`) VALUES
(1, 'Men’s Wear', 'All types of men’s clothing including shirts, pants, and jackets.'),
(2, 'Women’s Wear', 'All types of women’s clothing including dresses, skirts, and blouses.'),
(3, 'Outerwear', 'Clothing worn outdoors, including jackets, coats, and rainwear.'),
(4, 'Sportswear', 'Clothing suitable for sport or physical exercise.'),
(5, 'Formal Wear', 'Clothing suitable for formal social events.'),
(6, 'Casual Wear', 'Everyday clothing that is not formal.'),
(7, 'Accessories', 'Items that can be added to complement or complete outfits.'),
(8, 'Children’s Wear', 'Clothing designed for children.'),
(9, 'Sleepwear', 'Clothing designed to be worn while sleeping.'),
(10, 'Underwear', 'Clothing worn beneath outer clothes, typically next to the skin.'),
(11, 'Tops', 'Clothing items worn on the upper body.'),
(12, 'Bottoms', 'Clothing items worn on the lower body.'),
(13, 'Dresses', 'One-piece clothing items typically worn by women.'),
(14, 'Outerwear', 'Garments worn over other clothes for warmth or protection.'),
(15, 'Footwear', 'Items worn on the feet, such as shoes and boots.'),
(16, 'Bags & Accessories', 'Various bags and accessories, including backpacks, purses, and hats.'),
(17, 'Jewelry', 'Ornamental items such as bracelets, necklaces, and earrings.'),
(18, 'Headwear', 'Items worn on the head, including hats and caps.'),
(19, 'Eyewear', 'Accessories worn over the eyes, such as sunglasses and eyeglasses.'),
(20, 'Swimwear', 'Clothing designed for swimming and beach activities.'),
(21, 'Athletic Gear', 'Clothing and accessories designed for sports and athletic activities.'),
(22, 'Formal Wear', 'Clothing suitable for formal occasions, such as suits and dresses.'),
(23, 'Accessories', 'Various fashion accessories, including belts, ties, and scarves.'),
(24, 'Gloves & Mittens', 'Hand-covering garments for warmth and protection.'),
(25, 'Travel Accessories', 'Items designed to enhance travel comfort and convenience.'),
(26, 'Cold Weather Gear', 'Clothing and accessories suitable for cold climates and winter conditions.'),
(27, 'Winter Accessories', 'Accessories designed for use during the winter season.'),
(28, 'Electronics', 'Electronic devices and accessories, such as headphones and smartwatches.'),
(29, 'Miscellaneous', 'Other miscellaneous items not covered by other categories.');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StockQuantity` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Price`, `StockQuantity`, `CategoryID`, `ImageURL`, `CreatedAt`, `UpdatedAt`) VALUES
(11, 'T-Shirt', 'Classic crew neck and short sleeves make this t-shirt a comfortable and stylish choice for everyday wear. The high-quality graphic print on the front adds a unique touch.Material: 100% CottonSize: S-XXLQuantity Available: 50Care Instructions: Machine washable', 20.00, 11, 1, '../../assets/images/product_11-1711927697-card3.avif', '2024-03-26 15:26:55', '2024-04-01 02:10:28'),
(12, 'Skinny Jeans', 'Featuring a straight-leg cut, these jeans offer a timeless style with their blue denim material and subtle fading. The mid-rise waist and classic five-pocket design provide both comfort and convenience.Material: Premium DenimSize: Waist 28-38 inches, Inseam 32 inchesQuantity Available: 30Care Instructions: Machine wash cold', 40.00, 30, 2, '../../assets/images/product_12-product_12-jeans.png', '2024-03-26 15:26:55', '2024-04-01 00:12:50'),
(13, 'Dress', 'This summer floral dress features a V-neck, short sleeves, and a knee-length skirt, making it perfect for sunny days. \nThe vibrant pattern and lightweight material ensure both style and comfort.\nMaterial: Lightweight Breathable Fabric\nSize: XS-XL\nQuantity Available: 25\nCare Instructions: Machine wash gentle', 60.00, 25, 3, '../../assets/images/dress.jpg', '2024-03-26 15:26:55', '2024-03-31 01:44:54'),
(14, 'Jacket', 'Our leather biker jacket, crafted from genuine leather, includes a notched lapel, asymmetric zip closure, and quilted lining for added warmth. \nIts the perfect blend of style and functionality.\nMaterial: Genuine Leather\nSize: S-XL\nQuantity Available: 15\nCare Instructions: Professional leather clean only', 120.00, 15, 4, '../../assets/images/card10.png', '2024-03-26 15:26:55', '2024-03-31 01:45:17'),
(15, 'Sweater', 'This wool blend crewneck sweater is soft and perfect for layering. The ribbed trim adds a timeless look, making it versatile for both casual and formal wear.\nMaterial: Wool Blend\nSize: XS-XXL\nQuantity Available: 40\nCare Instructions: Hand wash cold, lay flat to dry', 35.00, 40, 1, '../../assets/images/card2.png', '2024-03-26 15:26:55', '2024-03-31 01:45:21'),
(16, 'Blouse', 'Featuring a luxurious silk material, this blouse offers a smooth feel and a flattering drape.\n Its elegantly designed with long sleeves and a round neckline, suitable for formal settings.\nMaterial: Silk\nSize: XS-L\nQuantity Available: 20\nCare Instructions: Dry clean only', 45.00, 20, 3, '../../assets/images/card7.png', '2024-03-26 15:26:55', '2024-03-31 01:58:07'),
(17, 'Skirt', 'A versatile mini skirt in black with a high waist and A-line cut. The stretch fabric and hidden zipper offer both comfort and a sleek look.Material: Stretch FabricSize: S-LQuantity Available: 30Care Instructions: Machine wash cold', 25.00, 30, 3, '../../assets/images/product_17-pleatedskirt.png', '2024-03-26 15:26:55', '2024-04-01 00:14:49'),
(18, 'Cargo Pants', 'Designed for comfort and practicality, these relaxed fit cargo pants feature multiple utility pockets and an adjustable drawstring waist. \nIdeal for outdoor or casual wear.\nMaterial: Cotton Blend\nSize: M-XXL\nQuantity Available: 25\nCare Instructions: Machine wash', 55.00, 25, 2, '../../assets/images/card4.png', '2024-03-26 15:26:55', '2024-03-31 01:47:50'),
(19, 'Hoodie', ' Our unisex pullover hoodie features a soft, fleece-lined interior, making it the ultimate comfort piece for your wardrobe. \nDesigned with versatility in mind, it includes a kangaroo pocket, ribbed cuffs, and an adjustable hood. Ideal for layering or as a standalone piece.\nMaterial: 70% Cotton, 30% Polyester Fleece\nSize: S-XXL\nQuantity Available: 35\nCare Instructions: Machine wash cold', 30.00, 35, 1, '../../assets/images/card12.png', '2024-03-26 15:26:55', '2024-03-31 01:57:50'),
(20, 'Leggings', 'Crafted for comfort and style, these stretch fabric leggings are a must-have for your active lifestyle or casual wear. \nFeaturing a high-rise fit that flatters any body type and a breathable, stretchy fabric that moves with you.\nMaterial: 88% Polyester, 12% Spandex\nSize: XS-XL\nQuantity Available: 40\nCare Instructions: Machine wash cold', 20.00, 40, 2, '../../assets/images/card13.png', '2024-03-26 15:26:55', '2024-03-31 01:57:31'),
(79, 'Sneakers', ' Step into comfort with our canvas sneakers, available in various colors to complement your unique style. These sneakers are designed with a durable rubber sole for traction and a canvas upper for lightweight, breathable wear.Material: Canvas Upper, Rubber SoleSize: US Mens 7-12, including half sizesQuantity Available: 20Care Instructions: Spot clean with a damp cloth and mild detergent. Air dry.', 50.00, 20, 6, '../../assets/images/product_79-sneakers12.png', '2024-03-26 16:21:11', '2024-04-01 00:14:06'),
(80, 'Backpack', 'This water-resistant hiking backpack is built for the adventurer in you. With multiple compartments for organization, a padded back panel for comfort, and adjustable straps, its your perfect companion for hikes or everyday use.Material: High-Density Nylon FabricSize: 20L Capacity; 18&#34; H x 12&#34; W x 6&#34; DQuantity Available: 15Care Instructions: Wipe clean with a damp cloth. Do not machine wash', 65.00, 15, 6, '../../assets/images/product_80-backpack.jpg', '2024-03-26 16:21:11', '2024-04-01 00:15:00'),
(81, 'Watch', 'Elegance meets functionality in our stainless steel analog watch. Featuring a sleek design with a durable stainless steel strap and a water-resistant case, this watch is perfect for daily wear or special occasions.\nMaterial: Stainless Steel Case and Strap\nSize: One Size Fits All; Adjustable Strap\nQuantity Available: 10\nCare Instructions: Clean gently with a soft, damp cloth. Avoid direct contact with strong chemicals.', 80.00, 10, 7, '../../assets/images/watch.png', '2024-03-26 16:21:11', '2024-03-31 04:02:54'),
(82, 'Hat', 'This adjustable baseball cap is both stylish and practical, made with breathable fabric to keep you cool. Perfect for outdoor activities or everyday wear, its adjustable strap ensures a comfortable fit for all head sizes.Material: Durable Cotton BlendSize: One Size Fits Most; Adjustable StrapQuantity Available: 50Care Instructions: Hand wash cold, lay flat to dry. Do not bleach.', 15.00, 50, 6, '../../assets/images/product_82-hat.jpg', '2024-03-26 16:21:11', '2024-04-01 00:15:15'),
(83, 'Sunglasses', ' Protect your eyes in style with our polarized UV protection sunglasses. Featuring a classic design that suits any face shape, these sunglasses are perfect for reducing glare and enhancing vision clarity on sunny days.\nMaterial: High-Quality Polycarbonate Lenses, Metal Frame\nSize: One Size Fits Most\nQuantity Available: 40\nCare Instructions: Clean with a soft, dry cloth. Store in a protective case to avoid scratches.', 25.00, 40, 9, '../../assets/images/sunglasses.jpg', '2024-03-26 16:21:11', '2024-03-31 04:06:34'),
(84, 'Swim Shorts', ' Hit the beach or the pool in our quick-dry swim trunks for men. Designed for comfort and style, these trunks feature an adjustable drawstring waist and a mesh lining. The vibrant colors and patterns are sure to stand out.\nMaterial: Quick-Dry Polyester Fabric\nSize: S-XXL\nQuantity Available: 35\nCare Instructions: Machine wash cold.', 30.00, 35, 10, '../../assets/images/swimshorts.jpeg', '2024-03-26 16:21:11', '2024-03-31 04:06:27'),
(85, 'Sandals', 'Our flip-flop sandals are the perfect beachwear companion. Designed with comfort in mind, they feature a durable rubber sole and a soft strap to prevent chafing. The lightweight design makes them easy to pack for your next sunny getaway.\nMaterial: Rubber Sole, Soft Fabric Strap\nSize: US Mens 6-12\nQuantity Available: 45\nCare Instructions: Wipe clean with a damp cloth.', 20.00, 45, 5, '../../assets/images/sandles.jpg', '2024-03-26 16:21:11', '2024-03-31 04:12:58'),
(86, 'Running Shoes', 'Experience the ultimate in comfort and performance with our lightweight running shoes. Featuring a breathable mesh upper and a cushioned sole, these shoes are designed to support and protect your feet through every run.Material: Breathable Mesh Upper, Durable Rubber SoleSize: US Mens 7-13, including half sizesQuantity Available: 25Care Instructions: Spot clean with mild detergent, air dry.', 70.00, 25, 11, '../../assets/images/product_86-runnningshoe.jpg', '2024-03-26 16:21:11', '2024-04-01 00:15:28'),
(87, 'Tie', ' Add a touch of elegance to your formal attire with our classic silk necktie. Made from high-quality silk, this tie offers a smooth, luxurious feel and a sophisticated sheen that complements any suit or dress shirt.\nMaterial: 100% Silk\nSize: Length: 58 inches, Width: 3.25 inches\nQuantity Available: 30\nCare Instructions: Dry clean only.', 40.00, 30, 12, '../../assets/images/tie.jpg', '2024-03-26 16:21:11', '2024-03-31 04:13:20'),
(88, 'Belt', 'Crafted from genuine leather, this belt is both stylish and durable. Featuring a sleek metal buckle, its the perfect accessory to complete any outfit, from casual to formal.\nMaterial: Genuine Leather\nSize: Waist 28-44 inches, adjustable\nQuantity Available: 40\nCare Instructions: Clean with a soft, dry cloth.', 35.00, 40, 13, '../../assets/images/belt.jpg', '2024-03-26 16:21:11', '2024-03-31 04:13:29'),
(89, 'Gloves', 'Stay warm and connected with our winter gloves, featuring touchscreen-compatible fingertips. Made with a cozy knit, these gloves allow you to use your smartphone or tablet without exposing your hands to the cold.\nMaterial: Acrylic Knit with Touchscreen-Compatible Fingertips\nSize: S-L\nQuantity Available: 35\nCare Instructions: Hand wash cold, lay flat to dry.', 20.00, 35, 14, '../../assets/images/gloves.jpeg', '2024-03-26 16:21:11', '2024-03-31 04:13:39'),
(90, 'Umbrella', 'This compact travel umbrella is your perfect companion for unpredictable weather. Designed with a durable windproof frame and a quick-dry waterproof fabric, it offers both protection and ease of use. Its collapsible design fits easily into bags and backpacks.\nMaterial: Waterproof Polyester, Stainless Steel Frame\nSize: One Size; 36 inches in diameter when open\nQuantity Available: 40\nCare Instructions: Leave open to dry. Wipe clean with a damp cloth.', 15.00, 40, 15, '../../assets/images/umbrella.jpg', '2024-03-26 16:21:11', '2024-03-31 04:13:52'),
(91, 'Beanie', 'Keep warm and stylish with our knit beanie hat, perfect for winter weather. Made from soft, stretchy fabric that comfortably fits all head sizes, this beanie is both functional and fashionable.Material: Acrylic KnitSize: One Size Fits MostQuantity Available: 30Care Instructions: Machine wash cold.', 25.00, 30, 16, '../../assets/images/product_91-beanie.png', '2024-03-26 16:21:11', '2024-04-01 00:16:05'),
(92, 'Scarf', 'Wrap yourself in luxury with our cashmere scarf. Its softness and warmth provide comfort and elegance, making it the perfect accessory for cold weather. The scarfs generous size allows for versatile styling.\nMaterial: 100% Cashmere\nSize: 70 inches x 12 inches\nQuantity Available: 20\nCare Instructions: Dry clean only.', 45.00, 20, 17, '../../assets/images/scarf.jpg', '2024-03-26 16:21:11', '2024-03-31 04:15:42'),
(93, 'Wallet', 'Our slim leather wallet combines style with functionality. Featuring RFID protection to keep your cards safe, it includes multiple slots for cards and cash without the bulk. Its sleek design fits easily in pockets.\nMaterial: Genuine Leather with RFID Blocking\nSize: 4.5 inches x 3.5 inches\nQuantity Available: 25\nCare Instructions: Wipe clean with a soft, dry cloth.', 50.00, 25, 18, '../../assets/images/wallet.jpg', '2024-03-26 16:21:11', '2024-03-31 04:14:47'),
(95, 'Tie-Dye Shirt', 'Stand out with our colorful tie-dye t-shirt. Each shirt is unique with its vibrant patterns, offering a comfortable fit for casual wear. Made from soft cotton, its a fun addition to any wardrobe.Material: 100% CottonSize: S-XXLQuantity Available: 35Care Instructions: Machine wash cold, tumble dry low. Wash separately', 25.00, 35, 1, '../../assets/images/product_95-tie.jpg', '2024-03-26 16:21:11', '2024-04-01 00:16:20'),
(96, 'Cargo Shorts', 'These men’s cargo shorts are designed for comfort and practicality. Featuring multiple pockets for storage, they are perfect for outdoor adventures or casual outings. The durable fabric and relaxed fit ensure lasting wear and freedom of movement.Material: Cotton BlendSize: 30-40 inches waist; Inseam approximately 9 inchesQuantity Available: 30Care Instructions: Machine wash cold', 30.00, 30, 2, '../../assets/images/product_96-card1.png', '2024-03-26 16:21:11', '2024-04-01 00:16:31'),
(97, 'Denim Jacket', 'A classic denim jacket that never goes out of style. With a button-front closure, adjustable waist tabs, and multiple pockets, its as functional as it is fashionable. Perfect for layering over tees or sweaters.Material: 100% Cotton DenimSize: S-XLQuantity Available: 20Care Instructions: Machine wash cold', 55.00, 20, 4, '../../assets/images/product_97-card8.webp', '2024-03-26 16:21:11', '2024-04-01 00:16:53'),
(98, 'Hiking Boots', 'Tackle any terrain with our waterproof hiking boots. Designed for durability and comfort, they feature a reinforced toe, supportive ankle design, and a grippy sole. Ideal for both seasoned hikers and casual explorers.Material: Waterproof Leather Upper, Rubber OutsoleSize: US Mens 7-12, including half sizesQuantity Available: 15Care Instructions: Wipe with a damp cloth, air dry.', 85.00, 15, 3, '../../assets/images/product_98-hikingshoes.png', '2024-03-26 16:21:11', '2024-04-01 00:17:49'),
(99, 'Trench Coat', 'This double-breasted trench coat is a timeless wardrobe staple. Crafted from water-resistant fabric, it features a belted waist, buttoned pockets, and adjustable cuff straps. Lined for added warmth and comfort.Material: Polyester Outer, Cotton LiningSize: S-XLQuantity Available: 10Care Instructions: Machine wash cold, hang to dry', 90.00, 10, 4, '../../assets/images/product_99-trenchcoat.png', '2024-03-26 16:21:11', '2024-04-01 00:18:46'),
(100, 'Duffle Bag', 'Our canvas duffle bag is the perfect travel companion, offering a spacious main compartment and multiple pockets for organization. Durable and stylish, it features both hand straps and a detachable shoulder strap for versatile carrying options.Material: Canvas, Leather AccentsSize: 22 inches L x 10 inches W x 11 inches HQuantity Available: 20Care Instructions: Spot clean only.', 75.00, 20, 16, '../../assets/images/product_100-dufflebag.webp', '2024-03-26 16:21:11', '2024-04-01 00:19:28'),
(104, 'Crossbody Bag', 'Our small crossbody bag is designed for everyday use, offering convenience and style. It features multiple compartments for easy organization and an adjustable strap for comfort. The perfect size to carry your essentials.Material: Durable Fabric, Metal ZippersSize: 9 inches H x 8 inches W x 2 inches DQuantity Available: 30Care Instructions: Spot clean with a damp cloth.', 40.00, 30, 6, '../../assets/images/product_104-bag12.png', '2024-03-26 16:21:11', '2024-04-01 00:20:50'),
(105, 'Sunhat', 'Protect yourself from the sun in style with our wide-brimmed sun hat. Made from lightweight, breathable material, its ideal for beach days, gardening, or any outdoor activity.Material: Straw-like FabricSize: One Size Fits Most; Adjustable Inner BandQuantity Available: 25Care Instructions: Spot clean only', 20.00, 25, 8, '../../assets/images/product_105-sunhat.jpg', '2024-03-26 16:21:11', '2024-04-01 00:41:44'),
(109, 'Bowler Hat', 'Embrace classic style with our felt bowler hat. Perfect for formal events or adding a vintage touch to your everyday look, this hat features a rounded crown and a narrow brim.Material: Wool FeltSize: S, M, L (please refer to our sizing chart)Quantity Available: 20Care Instructions: Dust with a soft brush. Store in a hat box to maintain shape.', 30.00, 20, 6, '../../assets/images/product_109-bowlhat.png', '2024-03-26 16:21:11', '2024-04-01 00:42:39'),
(110, 'Knit Gloves', 'Stay warm and stylish with our cozy knit gloves. Designed for the cold weather, they feature a soft yarn and ribbed cuffs to keep the warmth in. The perfect winter accessory for any outfit.Material: Acrylic KnitSize: One Size Fits MostQuantity Available: 40Care Instructions: Machine wash cold, lay flat to dry.', 15.00, 40, 14, '../../assets/images/product_110-knitgloves.png', '2024-03-26 16:21:11', '2024-04-01 00:43:20'),
(112, 'Winter Scarf', 'Wrap up warm with our chunky knit winter scarf. Its thick weave offers maximum warmth and comfort, while the variety of colors can complement any winter coat or outfit.Material: Wool BlendSize: 72 inches L x 9 inches WQuantity Available: 30Care Instructions: Hand wash cold, lay flat to dry.', 35.00, 30, 16, '../../assets/images/product_112-whitescarf.png', '2024-03-26 16:21:11', '2024-04-01 00:44:05'),
(113, 'Leather Wallet', 'Our slim leather wallet is designed for those who prefer minimalism without sacrificing functionality. It features a coin pocket, multiple card slots, and RFID protection to keep your information secure.Material: Genuine LeatherSize: 4 inches L x 3 inches HQuantity Available: 25Care Instructions: Clean with a soft, dry cloth', 45.00, 25, 17, '../../assets/images/product_113-walletleather.png', '2024-03-26 16:21:11', '2024-04-01 00:45:18'),
(115, 'Baseball Cap', 'Our vintage-style baseball cap adds a touch of retro cool to any casual outfit. Made from durable fabric, it features an adjustable strap for a personalized fit and a curved brim to shield your eyes from the sun.Material: Cotton BlendSize: One Size Fits Most; Adjustable StrapQuantity Available: 45Care Instructions: Hand wash cold, air dry.', 20.00, 45, 19, '../../assets/images/product_115-cap.webp', '2024-03-26 16:21:11', '2024-04-01 00:45:55'),
(116, 'Turtleneck Sweater', 'Embrace the cooler months with our cozy turtleneck sweater. Designed for warmth and comfort, this sweater is perfect for layering or wearing on its own. The ribbed knit offers a snug fit, while the turtleneck collar adds extra warmth.Material: Wool BlendSize: S-XXLQuantity Available: 25Care Instructions: Machine wash cold on a gentle cycle, lay flat to dry.', 40.00, 25, 1, '../../assets/images/product_116-tneck.webp', '2024-03-26 16:21:11', '2024-04-01 00:46:18'),
(119, 'Ankle Boots', 'These stylish leather ankle boots are designed to complement any outfit, from jeans to dresses. The boots feature a comfortable fit, a durable sole for excellent traction, and a side zipper for easy on and off.Material: Genuine LeatherSize: US Womens 6-10Quantity Available: 10Care Instructions: Clean with a leather cleaner and conditioner.', 70.00, 10, 5, '../../assets/images/product_119-ankleb.webp', '2024-03-26 16:21:11', '2024-04-01 00:47:00'),
(121, 'Messenger Bag', 'Ideal for daily use, our canvas messenger bag combines functionality with style. It features a spacious main compartment, several smaller pockets for organization, and an adjustable shoulder strap for comfort.Material: Durable CanvasSize: 15 inches L x 11 inches H x 5 inches DQuantity Available: 20Care Instructions: Spot clean with mild soap and water.', 55.00, 20, 6, '../../assets/images/product_121-messengerbag.webp', '2024-03-26 16:21:11', '2024-04-01 00:47:42'),
(126, 'Bucket Hat', 'Our trendy bucket hat offers both style and sun protection. Made with lightweight, breathable fabric, its perfect for sunny days outdoors. The wide brim shields your face from the sun, making it an essential accessory for any casual outfit.Material: 100% CottonSize: One Size Fits MostQuantity Available: 25Care Instructions: Hand wash cold, air dry.', 20.00, 25, 8, '../../assets/images/product_126-buckethat.webp', '2024-03-26 16:21:11', '2024-04-01 00:48:49'),
(127, 'Rolling Backpack', 'Designed for versatility and convenience, our rolling backpack features durable wheels and a retractable handle, making it perfect for travel or daily use. It includes multiple compartments for laptops, books, and other essentials.Material: High-Density PolyesterSize: 20 inches H x 14 inches W x 9 inches DQuantity Available: 15Care Instructions: Wipe with a damp cloth.', 70.00, 15, 10, '../../assets/images/product_127-rollback.webp', '2024-03-26 16:21:11', '2024-04-01 00:49:24'),
(136, 'Beanie Hat', 'Stay warm and stylish with our warm knit beanie hat. Made from soft, thick yarn, it is  perfect for keeping your head cozy during the winter months. The stretchable fabric ensures a comfortable fit for all.Material: Acrylic KnitSize: One Size Fits MostQuantity Available: 40Care Instructions: Machine wash cold, lay flat to dry.', 20.00, 40, 19, '../../assets/images/product_136-beaniehatkid.webp', '2024-03-26 16:21:11', '2024-04-01 00:50:19'),
(143, 'deel', 'Mongolian trad attire', 999.00, 11, 3, '../../assets/images/deel.png', '2024-03-31 04:11:16', '2024-03-31 04:11:16'),
(145, 'Long Sleeves', 'long sleeves', 99.00, 9, 1, '../../assets/images/product_145-longsl.webp', '2024-03-31 22:19:57', '2024-04-01 00:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` enum('client','admin') NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `LastLogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Role`, `CreatedAt`, `LastLogin`) VALUES
(1, 'Jo Kim', '$2y$10$WPIp6iJWehMPYTA0LGmXCe9JpBmrBgDZRmnx1FnuMUv/96/OcNKMK', 'bsnlkhm@gmail.com', 'client', '2024-03-28 20:21:22', NULL),
(3, 'theworldofjoes', '$2y$10$505hXGF88ku4y1M9eBFk.e26PhbGtSpnABYgmvarRtGXCTR10H3CS', 'jotamir@rocks.com', 'client', '2024-03-29 02:01:45', NULL),
(5, 'gungaa', '$2y$10$Rj8CjoDfWtZiV.K1c18LYevzpFg/5Req87lpa4sLE3qfCvlnMnu/e', 'gungaa@gmail.com', 'client', '2024-03-30 01:58:31', NULL),
(7, 'Davaanyam', '$2y$10$uC4TOsY40yhvtpYDiohsgOuoVJWnvsYXeONOnHFxuTBZbFtBa8KT2', 'avaadyav@gmail.com', 'client', '2024-03-30 23:51:41', NULL),
(8, 'jo', '$2y$10$4KElC8WBqaYSRH39V//e/.X.LsasFnTm.3US.8cTGcuVm6jIs/TYS', 'jo@jo.jo', 'admin', '2024-03-30 23:52:28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
