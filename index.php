<?php
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy: worker-src https:');

include('templates/defaults/header.tpl.php');

include('templates/home.tpl.php');

include('templates/defaults/end.tpl.php');

//retrieving filename from url
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
}
else{
    $filename = "";
}

//bringing user to different pages
if ($userInfo == true){
    switch($filename){
        case 'about':
            include '/templates/defaults/header.tpl.php';
            include '/templates/about.tpl.php';
        break;

        case 'rubrix':
            include '/templates/defaults/header.tpl.php';
            include '/templates/judgingRubrix.tpl.php';
        break;

        case 'pastGames':
            include '/templates/defaults/header.tpl.php';
            include '/templates/pastGames.tpl.php';
        break;

        case 'gallery':
            include '/templates/defaults/header.tpl.php';
            include '/templates/gallery.tpl.php';
        break;

        case 'game':
            include '/templates/defaults/header.tpl.php';
            include '/template/game.tpl.php';
        break;

        default:
            include '/templates/defaults/header.tpl.php';
            include('templates/home.tpl.php');
    }
}
?>