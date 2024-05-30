<?php

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);

$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
if (is_array($domain)) {
    // If $_SERVER['HTTP_HOST'] is an array, try to extract the first element
    $domain = isset($_SERVER['HTTP_HOST'][0]) ? $_SERVER['HTTP_HOST'][0] : '';
}

// Set session cookie parameters
session_set_cookie_params(
    1800,
    '/',
    $domain,
    isset($_SERVER['HTTPS']), // Ensure secure cookies only if using HTTPS
    true
);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set the session timeout to 30 mins
$sessionTimeout = 30 * 60; // 30 mins

// Check if session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
    // Session has expired, destroy it
    session_unset();
    session_destroy();
    // Optionally, you can start a new session here if needed
    session_start();
    session_regenerate_id(true);
}

// Update last activity time to current
$_SESSION['last_activity'] = time();
?>