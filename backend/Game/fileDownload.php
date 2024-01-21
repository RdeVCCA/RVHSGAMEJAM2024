<?php
$sql_info = 'SELECT GameFiles FROM games WHERE Id = ?';
            
$Thumbnail = "";
$GameName = "";
$Author = "";
$Genre = "";
$Descriptions = "";
$GameFiles = "";
$Trailer = "";

$stmt = prepared_query($conn, $sql_info, [$gameId], 's');
$stmt->bind_result($Thumbnail, $GameName, $Author, $Genre, $Descriptions, $GameFiles, $Trailer);
$stmt->fetch();
mysqli_stmt_close($stmt);
?>