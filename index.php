<?php
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy: worker-src https:');

// include('templates/defaults/header.tpl.php');

// include('templates/home.tpl.php');

// include('templates/defaults/end.tpl.php');

require_once "backend/Defaults/connect.php";
require_once "backend/Game/ratings.php";

//retrieving filename from url
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
}
else{
    $filename = "";
}

//retrieving userInfo -> checking if user has logged in
$userInfo = true;

//bringing user to different pages
if ($userInfo == true){
    switch($filename){
        case 'about':
            include 'templates/defaults/header.tpl.php';
            include 'templates/about.tpl.php';
        break;

        case 'rubrix':
            include 'templates/defaults/header.tpl.php';
            include 'templates/judgingRubrix.tpl.php';
        break;

        case 'pastGames':
            include 'templates/defaults/header.tpl.php';
            include 'templates/pastGames.tpl.php';
        break;

        case 'gallery':
            include 'templates/defaults/header.tpl.php';
            include 'templates/gallery.tpl.php';
        break;

        case 'game':
            include 'templates/defaults/header.tpl.php';
            include 'templates/game.tpl.php';
        break;

        default:
            include 'templates/defaults/header.tpl.php';
            include('templates/home.tpl.php');
    }
} else{
    include 'templates/defaults/header.tpl.php';
    include('templates/home.tpl.php');
}

include('templates/defaults/end.tpl.php');
?>