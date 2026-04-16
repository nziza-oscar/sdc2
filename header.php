<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/constants.php';
require_once 'tools.php';
require_once 'includes/tracker.php';

$current_page = basename($_SERVER['PHP_SELF']);
trackPageView($current_page);

// Navigation Array
$nav_links = [
    'index.php'    => 'Home',
    'about.php'    => 'About Us',
    'services.php' => 'Services',
    'projects.php' => 'Projects',
    'contact.php'  => 'Contact',
    'mission.php'  => 'Our Mission'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/x-icon" href="favicon/favicon.ico">
    <link rel="manifest" href="favicon/site.webmanifest">

    <meta name="description" content="Sustainable Design & Construction Consultancy - Building dreams with sustainable innovation in Rwanda.">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <meta name="title" content="<?php echo isset($page_title) ? $page_title . ' - SDC2' : 'SDC2 - Sustainable Design & Construction Consultancy'; ?>">
    <meta name="keywords" content="sustainable design, construction consultancy, architectural firm Kigali, green building Rwanda, construction management, SDC2">
    <meta name="author" content="SDC2 - Sustainable Design and Construction Consultancy">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="RW">
    <meta name="geo.placename" content="Kigali">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://sdc2consultancy.com/">
    <meta property="og:title" content="SDC2 - Sustainable Design and Construction Consultancy Rwanda">
    <meta property="og:description" content="Premium sustainable design and construction consultancy in Kigali.">
    <meta property="og:image" content="https://sdc2consultancy.com/images/og-image.jpg">
    <meta property="og:site_name" content="SDC2 Rwanda">
    
    <link rel="canonical" href="https://sdc2consultancy.com/<?php echo $current_page; ?>">
    <meta name="theme-color" content="#1a4d3e">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .hero-gradient { background: linear-gradient(135deg, #0a2d4d 0%, #164e63 100%); }
        .hex-shape { clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); }
        .accent-bg { background-color: #5eead4; }
        .reveal-up { opacity: 0; transform: translateY(30px); }
        #mobile-overlay { transform: translateX(100%); transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1); }
        #mobile-overlay.active { transform: translateX(0); }
        .gallery-item { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%); transition: clip-path 0.4s ease; }
        .gallery-item:hover { clip-path: polygon(5% 0, 100% 0, 95% 100%, 0 100%); }
    </style>
</head>
<body class="antialiased">

    <div id="mobile-overlay" class="fixed inset-0 z-[100] bg-[#0a2d4d] flex flex-col items-center justify-center p-8 text-white md:hidden">
        <button id="menu-close" class="absolute top-8 right-8 text-3xl">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="flex flex-col space-y-8 text-center text-xl font-semibold">
            <?php foreach ($nav_links as $url => $label): ?>
                <a href="<?= $url ?>" class="<?= ($current_page == $url) ? 'text-green-400' : 'hover:text-green-400' ?> transition">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
            <a href="contact.php" class="px-8 py-3 bg-green-400 text-cyan-900 rounded-full font-bold shadow-xl">Get In Touch</a>
        </div>
    </div>

    <header class="sticky top-0 z-[60] shadow-2xl">
        <div class="w-full bg-[#c95c0e] py-2 border-b border-orange-700/30 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap justify-between items-center text-[11px] md:text-sm">
                    <div class="flex flex-wrap items-center gap-4 md:gap-6">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-orange-200"></i>
                            <span class="font-medium">(+250) 788 282 953</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-orange-200"></i>
                            <span class="font-medium">connect2sdc2@gmail.com</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-orange-200"></i>
                            <span class="font-medium">Gasabo, Kigali</span>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center gap-4 border-l border-orange-400/40 pl-4">
                        <a href="https://www.facebook.com/profile.php?id=61576456765986" target="_blank" class="hover:text-orange-200 transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://x.com/Sdc2Connect" target="_blank" class="hover:text-orange-200 transition-colors"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/connect2sdc2/" target="_blank" class="hover:text-orange-200 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/sustainable-design-and-construction-consultancy-a7808b3ba" target="_blank" class="hover:text-orange-200 transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="bg-[#0a2d4d] text-white py-2">
            <div class="flex items-center justify-between px-6 md:px-8 mx-auto max-w-7xl">
                <a href="index.php" class="inline-block transition-transform hover:scale-105">
                    <img src="images/logo2.png" alt="SDC2 consultancy" class="block h-12 md:h-16 w-auto"/>
                </a>

                <div class="hidden lg:flex items-center space-x-8 text-sm font-medium">
                    <?php foreach ($nav_links as $url => $label): ?>
                        <a href="<?= $url ?>" 
                           class="transition pb-1 <?= ($current_page == $url) 
                                ? 'text-green-400 border-b-2 border-green-400' 
                                : 'hover:text-green-400 border-b-2 border-transparent hover:border-green-400' ?>">
                            <?= $label ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="flex items-center gap-4">
                    <a href="contact.php" class="hidden sm:block px-6 py-2 bg-green-400 text-cyan-900 rounded-full text-sm font-bold shadow-lg hover:bg-green-300 transition-all active:scale-95">
                        Get In Touch
                    </a>
                    <button id="menu-open" class="lg:hidden text-2xl focus:outline-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>