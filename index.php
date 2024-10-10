<?php
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy: worker-src https:');

// retrieving ?filename=... from url
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
} else {
    $filename = '';
}

// site-wide session
session_start();

require_once "backend/Defaults/connect.php";
if ($filename === 'login') {
    // session_start and session_destroy must be before header
    include 'templates/login.tpl.php';
} else {
    include 'templates/defaults/header.tpl.php';

    switch ($filename) {
        case 'gallery':
            include 'templates/gallery.tpl.php';
        break;

        case 'game':
            include 'templates/game.tpl.php';
        break;

        default:
            include 'templates/home.tpl.php';
    }

    include 'templates/defaults/end.tpl.php';
}
?>
