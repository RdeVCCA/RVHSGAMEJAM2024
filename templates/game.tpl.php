        <link rel = "stylesheet" href = "static/css/game.css">
    </head>

    <body>
        <div class = "center">
            <?php 
            //retrieving information from database about game based on gameId transferred through get variable
            $gameId = $_GET['game'];
            $sql_info = 'SELECT Thumbnail, GameName, Author, Genre, Descriptions, GameFiles, Trailer FROM games WHERE Id = ?';
            
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

            echo "<div id = 'Header'>";
                echo "<h1>$GameName</h1>";
                echo "<div>$Genre</div>";
                echo "<div>Created by $Author</div>";
            echo "</div>";
            
            echo "<div id = 'T_V'>";
                echo "<div id = 'startArrow'>&#x2190;</div>";
                echo "<img src = '$Thumbnail'>";
                echo "<div id = 'endArrow'> &#x2192;</div>";
            echo "</div>"
            ?>

            <div id = "gameButton">Play Game</div>
        </div>
        <?php
        echo "<div id = 'Description'>$Descriptions</div>";
        ?>

        <h2>Rate</h2>

