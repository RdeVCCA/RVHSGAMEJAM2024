<?php

function addRatings($ratings){
    if ($exist == 1){
        $sql = 'UPDATE ratings SET MainRating = ? WHERE UserEmail = ? AND gameName = ?';
        
        $stmt = prepared_query($conn, $sql, [$ratings[0], $userEmail, $gameName], 's');
        mysqli_stmt_close($stmt);

        $sql = 'UPDATE ratings SET MainRating = ? WHERE UserEmail = ? AND gameName = ?';
        
        $stmt = prepared_query($conn, $sql, [$ratings[1], $userEmail, $gameName], 's');
        mysqli_stmt_close($stmt);

        $sql = 'UPDATE ratings SET MainRating = ? WHERE UserEmail = ? AND gameName = ?';
        
        $stmt = prepared_query($conn, $sql, [$ratings[2], $userEmail, $gameName], 's');
        mysqli_stmt_close($stmt);

        $sql = 'UPDATE ratings SET MainRating = ? WHERE UserEmail = ? AND gameName = ?';
        
        $stmt = prepared_query($conn, $sql, [$ratings[3], $userEmail, $gameName], 's');
        mysqli_stmt_close($stmt);
    } else{
        $sql = 'SELECT COUNT(*) FROM games';
        $Id = ''; //to replace with actual login
        $coun = ($conn ->query($sql))->fetch_all();
            foreach($coun as $cou){
                foreach($cou as $co){
                    $count = $co; //array to string conversion
                }
            }

        $sql = 'INSERT ratings (?, ?, ?, ?, ?, ?, ?)';
        
        $stmt = prepared_query($conn, $sql, [$count, $userEmail, $gameName, $ratings[0], $ratings[1], $ratings[2], $ratings[3]], '');
        mysqli_stmt_close($stmt);
    }
}

