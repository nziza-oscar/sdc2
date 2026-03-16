<?php
// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include constants
require_once 'config/constants.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <meta name="description" content="Sustainable Design & Construction Consultancy - Building dreams with sustainable innovation in Rwanda">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <meta name="title" content="<?php echo isset($page_title) ? $page_title . ' - SDC2' : 'SDC2 - Sustainable Design & Construction Consultancy'; ?>">
    <meta name="description" content="SDC2 is a leading sustainable design and construction consultancy in Rwanda. We offer architectural design, construction management, and eco-friendly building solutions in Kigali and East Africa.">
    <meta name="keywords" content="sustainable design, construction consultancy, architectural firm Kigali, green building Rwanda, construction management, eco-friendly architecture, SDC2, sustainable construction East Africa, building consultants Rwanda">
    <meta name="author" content="SDC2 - Sustainable Design and Construction Consultancy">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="geo.region" content="RW">
    <meta name="geo.placename" content="Kigali">
    <meta name="geo.position" content="-1.9441;30.0619">
    <meta name="ICBM" content="-1.9441, 30.0619">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.sdc2.rw/">
    <meta property="og:title" content="SDC2 - Sustainable Design and Construction Consultancy Rwanda">
    <meta property="og:description" content="Premium sustainable design and construction consultancy in Kigali. We deliver innovative, eco-friendly architectural solutions for residential and commercial projects.">
    <meta property="og:image" content="https://www.sdc2.rw/images/og-image.jpg">
    <meta property="og:image:alt" content="SDC2 Sustainable Construction Project in Kigali">
    <meta property="og:site_name" content="SDC2 Rwanda">
    <meta property="og:locale" content="en_RW">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://www.sdc2.rw/">
    <meta name="twitter:title" content="SDC2 - Sustainable Design & Construction Consultancy">
    <meta name="twitter:description" content="Leading sustainable construction consultancy in Rwanda. Expert architectural design, project management, and green building solutions.">
    <meta name="twitter:image" content="https://www.sdc2.rw/images/twitter-image.jpg">
    <meta name="twitter:site" content="@SDC2_Rwanda">
    <meta name="twitter:creator" content="@SDC2_Rwanda">
    
    <!-- LinkedIn -->
    <meta property="linkedin:owner" content="sdc2-sustainable-design-construction">
    
    <!-- WhatsApp -->
    <meta property="og:whatsapp:image" content="https://www.sdc2.rw/images/whatsapp-share.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.sdc2.rw/<?php echo basename($_SERVER['PHP_SELF']); ?>">
    
    <!-- Favicon -->
    <!-- <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  -->
    
    <!-- Mobile Theme -->
    <meta name="theme-color" content="#1a4d3e">
    <meta name="msapplication-TileColor" content="#1a4d3e">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

   
    <style>
        /* Custom styles */
        .soft-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(0, 77, 64, 0.15);
        }
        
        /* Dark green color */
        .bg-dark-green {
            background-color: #1a4d3e;
        }
        
        /* Dark orange color */
        .bg-dark-orange {
            background-color: #c95c0e;
        }
        
        .text-dark-orange {
            color: #c95c0e;
        }
        
        .border-dark-orange {
            border-color: #c95c0e;
        }
        
        /* Update primary color to dark green */
        .text-primary {
            color: #1a4d3e !important;
        }
        
        .bg-primary {
            background-color: #1a4d3e !important;
        }
        
        .hover\:text-primary:hover {
            color: #1a4d3e !important;
        }
        
        .btn-primary {
            background-color: #1a4d3e;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            background-color: #c95c0e;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(201, 92, 14, 0.3);
        }
    </style>
</head>
<body class="antialiased">

<!-- Top Bar - Dark Orange -->
<div class="fixed top-0 left-0 w-full bg-[#c95c0e] py-2 z-50 border-b border-orange-700/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between items-center text-sm">
            <!-- Contact Info -->
            <div class="flex flex-wrap items-center gap-4 md:gap-6">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-phone text-orange-200"></i>
                    <span class="text-white font-medium">(+250) 790 022 000 / 111</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope text-orange-200"></i>
                    <span class="text-white font-medium">office@npd.co.rw</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-orange-200"></i>
                    <span class="text-white font-medium">Plot 37, Avenue, Kigali</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation - Dark Green Background -->
<nav class="fixed top-[30px] left-0 w-full bg-[#1a4d3e] z-40 border-b border-[#c95c0e]/30 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="index.php" class="text-2xl font-semibold tracking-tight">
                    <span class="text-white">SUSTAINABLE</span>
                    <span class="block text-sm tracking-wider text-orange-200">DESIGN & CONSTRUCTION</span>
                </a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <?php foreach($nav_items as $name => $link): ?>
                    <a href="<?php echo $link; ?>" 
                       class="text-white hover:text-orange-200 font-medium transition-colors duration-200 <?php echo (basename($_SERVER['PHP_SELF']) == $link) ? 'text-orange-200' : ''; ?>">
                        <?php echo $name; ?>
                    </a>
                <?php endforeach; ?>
                <a href="contact.php" class="bg-[#c95c0e] text-white px-6 py-2 rounded-full font-medium hover:bg-[#b04d0c] transition-all duration-300">Get in Touch</a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-white hover:text-orange-200">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#1a4d3e] border-t border-[#c95c0e]/30">
        <div class="px-4 py-6 space-y-3">
            <?php foreach($nav_items as $name => $link): ?>
                <a href="<?php echo $link; ?>" 
                   class="block text-white hover:text-orange-200 font-medium py-2">
                    <?php echo $name; ?>
                </a>
            <?php endforeach; ?>
            <a href="contact.php" class="block bg-[#c95c0e] text-white text-center px-6 py-3 rounded-full font-medium mt-4 hover:bg-[#b04d0c] transition-all duration-300">Get in Touch</a>
        </div>
    </div>
</nav>

<!-- Main content wrapper with padding for fixed navs (top bar + nav) -->
<main class="pt-[88px]">