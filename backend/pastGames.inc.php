<?php
include 'backend/camelCase.inc.php';

function convertToFileLink($name, $year, $type) {
    // `type` is one of 3 values, specify type to get different files:
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

$sql = "SELECT * FROM pastgames ORDER BY year DESC";
$result = mysqli_query($conn, $sql);
$pastGame = [];
while ($row = mysqli_fetch_assoc($result)) {
    $year = $row['year'];
    $new = [
        "title" => $row['name'],
        "link" => $row['link'],
        "description" => $row['description'],
        "creators" => $row['creators']
    ];
    $logo = convertToFileLink($row['name'], $year, 2); // get logo
    if (file_exists($logo)){
        $new['logo'] = $logo;
    }
    $video = convertToFileLink($row['name'], $year, 0); // get video
    if (file_exists($video)){
        $new['video'] = $video;
    }
    $thumbnail = convertToFileLink($row['name'], $year, 1); // get thumbnail
    if (file_exists($thumbnail)){
        $new['thumbnail'] = $thumbnail;
    }
    

    if (!isset($pastGame[$year])){
        $pastGame[$year] = [];
    }

    $pastGame[$year][$row["gameId"]] = $new;
}
?>
