<?php
require_once "backend/Defaults/connect.php";
function convertToCamelCase($string) {
    // Replace any non-letter and non-digit character with a space
    $string = preg_replace('/[^a-zA-Z0-9]/', ' ', $string);

    // Capitalize the first letter of each word and then remove spaces
    $string = str_replace(' ', '', ucwords($string));

    // Lowercase the first character of the string
    $string = lcfirst($string);

    return $string;
}


function convertToFileLink($name, $year, $type){
    // 0 = video, 1 = image, 2 = logo
    $mimeTypes = [
"mp4",
"png",
"png"
    ];
    $folders = [
        "videos",
        "thumbnails",
        "logos"
    ];
    $fileMimeType = $mimeTypes[$type];
    $folder = $folders[$type];
    $fileName = convertToCamelCase($name).".".$fileMimeType;
    $filePath = "static/pastGames/".$year."/".$folder."/".$fileName;
    return $filePath;
}
$sql = "SELECT * FROM pastGames";
$result = mysqli_query($conn, $sql);
$pastGame = [];
while ($row = mysqli_fetch_assoc($result)){
    $year = $row['year'];
    $new = [
        "name" => $row['name'],
        "link" => $row['link'],
        "description" => $row['description'],
        "creators" => $row['creators']
    ];
    $logo = convertToFileLink($row['name'], $year, 2);
    if (file_exists($logo)){
        $new['logo'] = $logo;
    }
    $video = convertToFileLink($row['name'], $year, 0);
    if (file_exists($video)){
        $new['video'] = $video;
    }
    
    $thumbnail = convertToFileLink($row['name'], $year, 1);
    if (file_exists($thumbnail)){
        $new['thumbnail'] = $thumbnail;
    }
    

    if (!isset($pastGame[$year])){
        $pastGame[$year] = [];
    }

    $pastGame[$year][$row["gameId"]] = $new;
    
}
?>