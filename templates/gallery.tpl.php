        <link rel = "stylesheet" href = "static/css/gallery.css">
    </head>

<?php 
//require a games table to store all the 2023 game information
$sql = 'SELECT COUNT(*) FROM games';
$count = mysqli_query($conn, $sql);
// echo($count);
while($rowData = mysqli_fetch_array($count)){
    $gamecount = intval($rowData[0].'<br>');
    echo $gamecount;
}

foreach(range(1, $gamecount) as $index){
    $sql_info = 'SELECT Thumbnail, GameName, Author, Genre FROM games WHERE Id = ?';
    $LNCG = prepared_query($conn, $sql_info, [$index], 's');
}


// $count = prepared_query($conn, $sql, []);
?>
    <body>    
        <h1> Browse Games </h1>
        <span id = "count" value = "<?php $count?>"></span>
        <div id = "appendGames"></div>
    </body>
