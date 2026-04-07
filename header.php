<?php
// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include constants
require_once 'config/constants.php';
require_once 'tools.php';
?>
<?php
// At the top of header.php after includes
require_once 'includes/tracker.php';
$current_page = basename($_SERVER['PHP_SELF']);
trackPageView($current_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    
    <!-- Favicon Links -->
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
    <meta name="keywords" content="sustainable design, construction consultancy, architectural firm Kigali, green building Rwanda, construction management, eco-friendly architecture, SDC2, sustainable construction East Africa, building consultants Rwanda">
    <meta name="author" content="SDC2 - Sustainable Design and Construction Consultancy">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="geo.region" content="RW">
    <meta name="geo.placename" content="Kigali">
    <meta name="geo.position" content="-1.9441;30.0619">
    <meta name="ICBM" content="-1.9441, 30.0619">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://sdc2consultancy.com/">
    <meta property="og:title" content="SDC2 - Sustainable Design and Construction Consultancy Rwanda">
    <meta property="og:description" content="Premium sustainable design and construction consultancy in Kigali. We deliver innovative, eco-friendly architectural solutions for residential and commercial projects.">
    <meta property="og:image" content="https://sdc2consultancy.com/images/og-image.jpg">
    <meta property="og:image:alt" content="SDC2 Sustainable Construction Project in Kigali">
    <meta property="og:site_name" content="SDC2 Rwanda">
    <meta property="og:locale" content="en_RW">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://sdc2consultancy.com/">
    <meta name="twitter:title" content="SDC2 - Sustainable Design & Construction Consultancy">
    <meta name="twitter:description" content="Leading sustainable construction consultancy in Rwanda. Expert architectural design, project management, and green building solutions.">
    <meta name="twitter:image" content="https://sdc2consultancy.com/images/twitter-image.jpg">
    <meta name="twitter:site" content="@SDC2_Rwanda">
    <meta name="twitter:creator" content="@SDC2_Rwanda">
    
    <meta property="linkedin:owner" content="sdc2-sustainable-design-construction">
    <meta property="og:whatsapp:image" content="https://sdc2consultancy.com/images/whatsapp-share.jpg">
    
    <link rel="canonical" href="https://sdc2consultancy.com/<?php echo basename($_SERVER['PHP_SELF']); ?>">
    
    <meta name="theme-color" content="#1a4d3e">
    <meta name="msapplication-TileColor" content="#1a4d3e">
    <meta name="msapplication-TileImage" content="favicon/web-app-manifest-192x192.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
        .soft-shadow { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); }
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -15px rgba(0, 77, 64, 0.15); }
        .bg-dark-green { background-color: #1a4d3e; }
        .bg-dark-orange { background-color: #c95c0e; }
        .text-dark-orange { color: #c95c0e; }
        .border-dark-orange { border-color: #c95c0e; }
        .text-primary { color: #1a4d3e !important; }
        .bg-primary { background-color: #1a4d3e !important; }
        .hover\:text-primary:hover { color: #1a4d3e !important; }
        
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

        body {
            color: #111827;
            background-color: white;
            line-height: 1.5;
            font-weight: 400;
            font-style: normal;
        }

        .active-link {
            color: #c95c0e !important;
            position: relative;
        }

        .active-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #c95c0e;
            border-radius: 2px;
        }

         .font-rale{
            font-family: "Raleway", sans-serif;
       }
         .font-poppi{
            font-family: "Poppins", sans-serif;
         }
    </style>
</head>
<body class="antialiased">
<div class="fixed top-0 left-0 w-full bg-[#c95c0e] py-2 z-50 border-b border-orange-700/30 font-rale text-sm text-white text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between items-center text-sm">
            <div class="flex flex-wrap items-center gap-4 md:gap-6">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-phone text-orange-200"></i>
                    <span class="text-white font-medium">(+250) 788 282 953</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope text-orange-200"></i>
                    <span class="text-white font-medium">connect2sdc2@gmail.com</span>
                </div>
                <div class="hidden sm:flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-orange-200"></i>
                    <span class="text-white font-medium">Gasabo, Kigali</span>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-4 border-l border-orange-400/40 pl-4">
                <a href="https://www.facebook.com/profile.php?id=61576456765986" target="_blank" class="text-white hover:text-orange-200 transition-colors">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://x.com/Sdc2Connect" target="_blank" class="text-white hover:text-orange-200 transition-colors">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href="https://www.instagram.com/connect2sdc2/" target="_blank" class="text-white hover:text-orange-200 transition-colors">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/in/sustainable-design-and-construction-consultancy-a7808b3ba" target="_blank" class="text-white hover:text-orange-200 transition-colors">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<nav class="fixed top-[35px] left-0 w-full bg-white z-40 border-b border-neutral-200 shadow-sm transition-all duration-300 font-rale">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="inline-block transition-transform hover:scale-105">
                    <img src="images/logo1.png" 
                         alt="SDC2 consultancy - Sustainable Construction and Development" 
                         width="250" 
                         height="100" 
                         class="block h-32 w-auto max-w-full"/>
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-6 lg:space-x-8">
                <?php foreach($nav_items as $name => $link): 
                    $is_active = ($current_page == $link) || ($link == 'index.php' && $current_page == '');
                ?>
                    <a href="<?php echo $link; ?>" 
                       class="font-medium transition-colors duration-200 py-2 <?php echo $is_active ? 'text-[#1a4d3e] border-b-2 border-[#c95c0e]' : 'text-neutral-900 hover:text-[#c95c0e]'; ?>">
                        <?php echo $name; ?>
                    </a>
                <?php endforeach; ?>
                <a href="contact.php" class="bg-[#c95c0e] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#b04d0c] transition-all duration-300 transform hover:-translate-y-0.5 shadow-md">Get in Touch</a>
            </div>
            
            <div class="md:hidden">
                <button type="button" onclick="toggleMobileMenu()" class="text-neutral-900 hover:text-[#c95c0e] focus:outline-none">
                    <i id="menu-icon" class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
    
    <div id="mobile-menu" class="hidden bg-white border-t border-neutral-100 animate-fade-in shadow-inner">
        <div class="px-4 py-6 space-y-3">
            <?php foreach($nav_items as $name => $link): ?>
                <a href="<?php echo $link; ?>" 
                   class="block text-neutral-900 hover:text-[#c95c0e] font-medium py-2 px-3 rounded-lg <?php echo ($current_page == $link) ? 'bg-neutral-50 text-[#1a4d3e]' : ''; ?>">
                    <?php echo $name; ?>
                </a>
            <?php endforeach; ?>
            <div class="flex gap-4 px-3 py-2 border-t border-neutral-100 mt-2">
                <a href="https://www.facebook.com/profile.php?id=61576456765986" target="_blank" class="text-neutral-600 hover:text-[#c95c0e]"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://x.com/Sdc2Connect" target="_blank" class="text-neutral-600 hover:text-[#c95c0e]"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.instagram.com/connect2sdc2/" target="_blank" class="text-neutral-600 hover:text-[#c95c0e]"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/sustainable-design-and-construction-consultancy-a7808b3ba" target="_blank" class="text-neutral-600 hover:text-[#c95c0e]"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <a href="contact.php" class="block bg-[#c95c0e] text-white text-center px-6 py-3 rounded-full font-semibold mt-4 shadow-sm hover:bg-[#b04d0c]">Get in Touch</a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        menu.classList.toggle('hidden');
        if (menu.classList.contains('hidden')) {
            icon.classList.replace('fa-xmark', 'fa-bars');
        } else {
            icon.classList.replace('fa-bars', 'fa-xmark');
        }
    }
</script>

<main class="pt-[115px]">