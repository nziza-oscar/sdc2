<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sdcc_cms');

function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function runQuery($conn, $sql) {
    if (!$conn->query($sql)) {
        die("Error: " . $conn->error . " | Query: " . $sql);
    }
}

function setupDatabase() {
    $conn = getDB();

    // USERS
    runQuery($conn, "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        full_name VARCHAR(100),
        role ENUM('admin','editor','viewer') DEFAULT 'editor',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // CONTACT
    runQuery($conn, "CREATE TABLE IF NOT EXISTS contact_info (
        id INT AUTO_INCREMENT PRIMARY KEY,
        phone_call VARCHAR(50),
        phone_whatsapp VARCHAR(50),
        email VARCHAR(100),
        address TEXT,
        google_maps TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // SOCIAL
    runQuery($conn, "CREATE TABLE IF NOT EXISTS social_links (
        id INT AUTO_INCREMENT PRIMARY KEY,
        platform VARCHAR(50) UNIQUE,
        url VARCHAR(255),
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // COMPANY
    runQuery($conn, "CREATE TABLE IF NOT EXISTS company_info (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(50) UNIQUE,
        content TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // CORE VALUES
    runQuery($conn, "CREATE TABLE IF NOT EXISTS core_values (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100),
        description TEXT,
        display_order INT,
        updated_by INT
    ) ENGINE=InnoDB");

    // SERVICES
    runQuery($conn, "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(100),
        name VARCHAR(255),
        display_order INT,
        updated_by INT
    ) ENGINE=InnoDB");

    // PROJECTS
    runQuery($conn, "CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        description TEXT,
        image VARCHAR(255),
        display_order INT,
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // TEAM
    runQuery($conn, "CREATE TABLE IF NOT EXISTS team (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        position VARCHAR(100),
        bio TEXT,
        image VARCHAR(255),
        linkedin VARCHAR(255),
        email VARCHAR(100),
        display_order INT,
        created_by INT
    ) ENGINE=InnoDB");

    // PAGE VIEWS
    runQuery($conn, "CREATE TABLE IF NOT EXISTS page_views (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page VARCHAR(100),
        visitor_ip VARCHAR(45),
        user_agent TEXT,
        viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX(page),
        INDEX(viewed_at)
    ) ENGINE=InnoDB");

    // DAILY STATS
    runQuery($conn, "CREATE TABLE IF NOT EXISTS daily_stats (
        id INT AUTO_INCREMENT PRIMARY KEY,
        view_date DATE UNIQUE,
        total_views INT DEFAULT 0,
        unique_visitors INT DEFAULT 0,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // SETTINGS
    runQuery($conn, "CREATE TABLE IF NOT EXISTS settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) UNIQUE,
        setting_value TEXT,
        updated_by INT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // ---- DEFAULT DATA ----

    // USERS
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        $admin = password_hash('admin123', PASSWORD_DEFAULT);
        $editor = password_hash('editor123', PASSWORD_DEFAULT);
        $viewer = password_hash('viewer123', PASSWORD_DEFAULT);

        runQuery($conn, "INSERT INTO users (username,password,email,full_name,role) VALUES
            ('admin','$admin','admin@sdc2.rw','Administrator','admin'),
            ('editor','$editor','editor@sdc2.rw','Content Editor','editor'),
            ('viewer','$viewer','viewer@sdc2.rw','Viewer','viewer')
        ");
    }

    // CONTACT
    $result = $conn->query("SELECT COUNT(*) as count FROM contact_info");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO contact_info (phone_call,phone_whatsapp,email,address) VALUES
            ('+250 790 022 000','+250 785 140 170','info@sdc2.rw','Kigali, Rwanda')
        ");
    }

    // SOCIAL
    $result = $conn->query("SELECT COUNT(*) as count FROM social_links");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO social_links (platform,url) VALUES
            ('instagram','https://instagram.com/sdc2'),
            ('twitter','https://twitter.com/sdc2'),
            ('facebook','https://facebook.com/sdc2'),
            ('linkedin','https://linkedin.com/company/sdc2')
        ");
    }

    // COMPANY
    $result = $conn->query("SELECT COUNT(*) as count FROM company_info");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO company_info (section,content) VALUES
            ('about','We are a sustainable design company.'),
            ('mission','Deliver quality design.'),
            ('vision','Be the best in East Africa.')
        ");
    }

    // CORE VALUES
    $result = $conn->query("SELECT COUNT(*) as count FROM core_values");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO core_values (title,description,display_order) VALUES
            ('Integrity','We are honest.',1),
            ('Innovation','We create new ideas.',2),
            ('Excellence','We deliver quality.',3)
        ");
    }

    // SERVICES
    $result = $conn->query("SELECT COUNT(*) as count FROM services");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO services (category,name,display_order) VALUES
            ('Architectural Design','Concept design',1),
            ('Construction','Project management',2)
        ");
    }

    // SETTINGS
    $result = $conn->query("SELECT COUNT(*) as count FROM settings");
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        runQuery($conn, "INSERT INTO settings (setting_key,setting_value) VALUES
            ('site_name','SDC2'),
            ('maintenance_mode','0')
        ");
    }

    $conn->close();
}

setupDatabase();
?>