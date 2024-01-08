        <link rel = "stylesheet" href = "static/css/gallery.css">
        <script src = "static/js/library/gallery.js"></script>
    </head>
    
    <body>    
        <h1> Browse Games </h1>
        <div id = "appendGames">
            <?php 
            //require to create a games table to store all the 2023 game information

            //finding out the number of games created in 2023 gamejam
            $sql = 'SELECT COUNT(*) FROM games';
            $coun = ($conn ->query($sql))->fetch_all();
            foreach($coun as $cou){
                foreach($cou as $co){
                    $count = $co; //array to string conversion
                }
            }

            //finding the details of each of the gamejam and turning into an array
            foreach(range(0, $count) as $index){
                //fetching of four details for each of the games
                $sql_info = 'SELECT Thumbnail, GameName, Author, Genre FROM games WHERE Id = ?';
                $Thumbnail = "";
                $GameName = "";
                $Author = "";
                $Genre = "";
                $stmt = prepared_query($conn, $sql_info, [$index], 's');
                $stmt->bind_result($Thumbnail, $GameName, $Author, $Genre);
                $stmt->fetch();
                mysqli_stmt_close($stmt);

                //echo out the four details
                echo "<div id = 'appendGame'>";
                    echo "<a href = '/RVHSGAMEJAM2023/index.php?filename=game'><img id = 'gameLogo' class = 'grid' src = $Thumbnail></a>";
                    echo "<span id = 'name' class = 'grid'>$GameName</span>";
                    echo "<span id = 'creator' class = 'grid'>$Author</span>";
                    echo "<span id = 'genre' class = 'grid'>$Genre</span>";
                echo "</div>";
            }

            //inserting the details into value of html tags and then retrieving and inserting using js

            // $count = prepared_query($conn, $sql, []);
            ?>
        </div>
    </body>
<html>