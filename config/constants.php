<?php
// Site constants
define('SITE_NAME', 'Sustainable Design & Construction Consultancy');
define('SITE_EMAIL', 'info@sustainableconstruct.com');
define('SITE_PHONE', '+250 785 035 071');
define('SITE_ADDRESS', 'M.peace plaza 3rd floor, Block B F3 31 room');
define('SITE_CITY', 'Kigali, Rwanda');

// Navigation items
$nav_items = [
    'Home' => 'index.php',
    'About Us' => 'about.php',
    'Services' => 'services.php',
    'Projects' => 'projects.php',
    'Contact' => 'contact.php'
];

// Social links
$social_links = [
    'LinkedIn' => '#',
    'Twitter' => '#',
    'Instagram' => '#',
    'Facebook' => '#'
];

// Service categories
$services = [
    'Architectural Design' => [
        'Conceptualization and design development',
        'Interior design and space planning',
        '3D modeling and visualization',
        'Sustainable design solutions',
        'Construction documentation'
    ],
    'Construction Management' => [
        'General contracting',
        'Construction planning and scheduling',
        'Cost estimation and budgeting',
        'Quality control and assurance',
        'Project coordination and supervision'
    ],
    'Renovation & Retrofitting' => [
        'Residential and commercial renovations',
        'Structural modifications',
        'Interior upgrades and finishes',
        'Adaptive reuse and restoration',
        'Energy-efficient retrofitting'
    ]
];

// Projects
$projects = [
    [
        'title' => 'Eco-Haven Residence',
        'category' => 'Residential',
        'image' => 'project1.jpg',
        'description' => 'Sustainable hillside villa with green roof'
    ],
    [
        'title' => 'Green Office Complex',
        'category' => 'Commercial',
        'image' => 'project2.jpg',
        'description' => 'Energy-efficient office building with solar integration'
    ],
    [
        'title' => 'Riverside Apartments',
        'category' => 'Residential',
        'image' => 'project3.jpg',
        'description' => 'Multi-family sustainable housing development'
    ],
    [
        'title' => 'Eco-Industrial Park',
        'category' => 'Industrial',
        'image' => 'project4.jpg',
        'description' => 'Sustainable manufacturing facility with rainwater harvesting'
    ]
];
?>