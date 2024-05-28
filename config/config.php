<?php

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
session_set_cookie_params([
    'lifetime' => 1800,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Start the session
session_start();

// Set the session timeout to 30 mins
$sessionTimeout = 30 * 60; // 30 mins

// Check if session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
    // Regenerate session ID
    session_regenerate_id(true);
}

// Update last activity time to current
$_SESSION['last_activity'] = time();


// TODO: Test this.
?>