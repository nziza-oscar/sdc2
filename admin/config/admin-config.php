<?php
session_start();

define('ADMIN_USERNAME', 'admin'); // Default, but we'll use database

// Role constants
define('ROLE_ADMIN', 'admin');
define('ROLE_EDITOR', 'editor');
define('ROLE_VIEWER', 'viewer');

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user has specific role
function hasRole($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
}

// Check if user can edit (admin or editor)
function canEdit() {
    return isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], [ROLE_ADMIN, ROLE_EDITOR]);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === ROLE_ADMIN;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Redirect if cannot edit
function requireEdit() {
    requireLogin();
    if (!canEdit()) {
        header('Location: dashboard.php?error=unauthorized');
        exit;
    }
}

// Redirect if not admin
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header('Location: dashboard.php?error=unauthorized');
        exit;
    }
}
?>