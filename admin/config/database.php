<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sdc2_cms');

function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Create tables if they don't exist
function setupDatabase() {
    $conn = getDB();
    
    // Users table with roles
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        full_name VARCHAR(100),
        role ENUM('admin', 'editor', 'viewer') DEFAULT 'editor',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Contact Info
    $conn->query("CREATE TABLE IF NOT EXISTS contact_info (
        id INT PRIMARY KEY AUTO_INCREMENT,
        phone_call VARCHAR(50),
        phone_whatsapp VARCHAR(50),
        email VARCHAR(100),
        address TEXT,
        google_maps TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Social Links
    $conn->query("CREATE TABLE IF NOT EXISTS social_links (
        id INT PRIMARY KEY AUTO_INCREMENT,
        platform VARCHAR(50) UNIQUE,
        url VARCHAR(255),
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Company Info
    $conn->query("CREATE TABLE IF NOT EXISTS company_info (
        id INT PRIMARY KEY AUTO_INCREMENT,
        section VARCHAR(50) UNIQUE,
        content TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Core Values
    $conn->query("CREATE TABLE IF NOT EXISTS core_values (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(100),
        description TEXT,
        display_order INT,
        updated_by INT,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Services
    $conn->query("CREATE TABLE IF NOT EXISTS services (
        id INT PRIMARY KEY AUTO_INCREMENT,
        category VARCHAR(100),
        name VARCHAR(255),
        display_order INT,
        updated_by INT,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Projects
    $conn->query("CREATE TABLE IF NOT EXISTS projects (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255),
        description TEXT,
        image VARCHAR(255),
        display_order INT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(id)
    )");
    
    // Team
    $conn->query("CREATE TABLE IF NOT EXISTS team (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100),
        position VARCHAR(100),
        bio TEXT,
        image VARCHAR(255),
        linkedin VARCHAR(255),
        email VARCHAR(100),
        display_order INT,
        created_by INT,
        FOREIGN KEY (created_by) REFERENCES users(id)
    )");
    
    // Page Views Tracking
    $conn->query("CREATE TABLE IF NOT EXISTS page_views (
        id INT PRIMARY KEY AUTO_INCREMENT,
        page VARCHAR(100),
        visitor_ip VARCHAR(45),
        user_agent TEXT,
        viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_page (page),
        INDEX idx_date (viewed_at)
    )");
    
    // Daily Stats
    $conn->query("CREATE TABLE IF NOT EXISTS daily_stats (
        id INT PRIMARY KEY AUTO_INCREMENT,
        view_date DATE UNIQUE,
        total_views INT DEFAULT 0,
        unique_visitors INT DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    
    // Settings table
    $conn->query("CREATE TABLE IF NOT EXISTS settings (
        id INT PRIMARY KEY AUTO_INCREMENT,
        setting_key VARCHAR(100) UNIQUE,
        setting_value TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (updated_by) REFERENCES users(id)
    )");
    
    // Insert default admin user if no users exist
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    if ($result->fetch_assoc()['count'] == 0) {
        // Encrypted passwords (all passwords are hashed for security)
        $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
        $editor_password = password_hash('editor123', PASSWORD_DEFAULT);
        $viewer_password = password_hash('viewer123', PASSWORD_DEFAULT);
        
        // Insert default users with encrypted passwords
        $conn->query("INSERT INTO users (username, password, email, full_name, role) VALUES 
                     ('admin', '$admin_password', 'admin@sdc2.rw', 'Administrator', 'admin'),
                     ('editor', '$editor_password', 'editor@sdc2.rw', 'Content Editor', 'editor'),
                     ('viewer', '$viewer_password', 'viewer@sdc2.rw', 'View Only', 'viewer')");
        
        echo "<!-- Default users created successfully with encrypted passwords -->";
    }
    
    // Insert default contact if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM contact_info");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO contact_info (phone_call, phone_whatsapp, email, address) VALUES 
                     ('+250 790 022 000', '+250 785 140 170', 'info@sdc2.rw', 'Plot 37, Avenue, Kigali')");
    }
    
    // Insert default social links if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM social_links");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO social_links (platform, url) VALUES
                     ('instagram', 'https://instagram.com/sdc2'),
                     ('twitter', 'https://twitter.com/sdc2'),
                     ('facebook', 'https://facebook.com/sdc2'),
                     ('linkedin', 'https://linkedin.com/company/sdc2')");
    }
    
    // Insert default company info if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM company_info");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO company_info (section, content) VALUES
                     ('about', 'We are a sustainable design and construction consultancy dedicated to creating eco-friendly, innovative spaces in Rwanda and across East Africa.'),
                     ('mission', 'To transform ideas into architectural masterpieces through innovative design and quality construction, while prioritizing sustainability and efficiency.'),
                     ('vision', 'To be East Africa\'s most trusted and innovative sustainable construction company.'),
                     ('story', 'SDC2 was founded in 2026 with a bold vision to bring sustainable, innovative design to Rwanda\'s growing construction industry. What started as a conversation between friends has quickly grown into a passionate team of architects and designers ready to challenge the status quo.'),
                     ('drive', 'We are driven by passion for sustainable design, commitment to excellence, and the desire to create spaces that positively impact communities.')");
    }
    
    // Insert default core values if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM core_values");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO core_values (title, description, display_order) VALUES
                     ('Integrity', 'We operate with honesty and transparency in every interaction.', 1),
                     ('Innovation', 'We embrace new ideas and technologies to deliver creative solutions.', 2),
                     ('Sustainability', 'We are committed to eco-friendly practices in every project.', 3),
                     ('Excellence', 'We never compromise on quality, ensuring every detail meets the highest standards.', 4),
                     ('Collaboration', 'We work closely with clients, partners, and communities.', 5)");
    }
    
    // Insert default services if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM services");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO services (category, name, display_order) VALUES
                     ('Architectural Design', 'Conceptualization and design development', 1),
                     ('Architectural Design', 'Interior design and space planning', 2),
                     ('Architectural Design', '3D modeling and visualization', 3),
                     ('Architectural Design', 'Sustainable design solutions', 4),
                     ('Architectural Design', 'Construction documentation', 5),
                     ('Construction Management', 'General contracting', 1),
                     ('Construction Management', 'Construction planning and scheduling', 2),
                     ('Construction Management', 'Cost estimation and budgeting', 3),
                     ('Construction Management', 'Quality control and assurance', 4),
                     ('Construction Management', 'Project coordination and supervision', 5),
                     ('Renovation & Retrofitting', 'Residential and commercial renovations', 1),
                     ('Renovation & Retrofitting', 'Structural modifications', 2),
                     ('Renovation & Retrofitting', 'Interior upgrades and finishes', 3),
                     ('Renovation & Retrofitting', 'Adaptive reuse and restoration', 4),
                     ('Renovation & Retrofitting', 'Energy-efficient retrofitting', 5)");
    }
    
    // Insert default settings if empty
    $result = $conn->query("SELECT COUNT(*) as count FROM settings");
    if ($result->fetch_assoc()['count'] == 0) {
        $conn->query("INSERT INTO settings (setting_key, setting_value) VALUES
                     ('site_name', 'SDC2 - Sustainable Design & Construction Consultancy'),
                     ('site_description', 'Leading sustainable construction consultancy in Rwanda'),
                     ('maintenance_mode', '0'),
                     ('items_per_page', '5')");
    }
    
    $conn->close();
}

// Run setup
setupDatabase();
?>