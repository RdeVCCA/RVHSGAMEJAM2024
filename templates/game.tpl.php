        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
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
        <div class = "margin">
            <h2>Rate</h2>
            <img src = "static/img/star.png" class = "Stars" id = "Star1" onmouseover="highlightStar(1)" onmouseout="unhighlightStar(1)" onclick="calculateRatings(1), permanentHighlight(1)">
            <img src = "static/img/star.png" class = "Stars" id = "Star2" onmouseover="highlightStar(2)" onmouseout="unhighlightStar(2)" onclick="calculateRatings(2), permanentHighlight(2)">
            <img src = "static/img/star.png" class = "Stars" id = "Star3" onmouseover="highlightStar(3)" onmouseout="unhighlightStar(3)" onclick="calculateRatings(3), permanentHighlight(3)">
            <img src = "static/img/star.png" class = "Stars" id = "Star4" onmouseover="highlightStar(4)" onmouseout="unhighlightStar(4)" onclick="calculateRatings(4), permanentHighlight(4)">
            <img src = "static/img/star.png" class = "Stars" id = "Star5" onmouseover="highlightStar(5)" onmouseout="unhighlightStar(5)" onclick="calculateRatings(5), permanentHighlight(5)">
            <div class = "ratings">
                <div id = "Criteria1">Relatedness to Theme</div>
                <div id = "Theme">
                    <img src = "static/img/star.png" class = "Star" id = "Star6" onmouseover="highlightStar(6)" onmouseout="unhighlightStar(6)" onclick="calculateRatings(1), permanentHighlight(6)">
                    <img src = "static/img/star.png" class = "Star" id = "Star7" onmouseover="highlightStar(7)" onmouseout="unhighlightStar(7)" onclick="calculateRatings(2), permanentHighlight(7)">
                    <img src = "static/img/star.png" class = "Star" id = "Star8" onmouseover="highlightStar(8)" onmouseout="unhighlightStar(8)" onclick="calculateRatings(3), permanentHighlight(8)">
                    <img src = "static/img/star.png" class = "Star" id = "Star9" onmouseover="highlightStar(9)" onmouseout="unhighlightStar(9)" onclick="calculateRatings(4), permanentHighlight(9)">
                    <img src = "static/img/star.png" class = "Star" id = "Star10" onmouseover="highlightStar(10)" onmouseout="unhighlightStar(10)" onclick="calculateRatings(5), permanentHighlight(10)">
                </div>
                <div id = "Criteria2">Aesthetic</div>
                <div id = "Aesthetic">
                    <img src = "static/img/star.png" class = "Star" id = "Star11" onmouseover="highlightStar(11)" onmouseout="unhighlightStar(11)" onclick="calculateRatings(1), permanentHighlight(11)">
                    <img src = "static/img/star.png" class = "Star" id = "Star12" onmouseover="highlightStar(12)" onmouseout="unhighlightStar(12)" onclick="calculateRatings(2), permanentHighlight(12)">
                    <img src = "static/img/star.png" class = "Star" id = "Star13" onmouseover="highlightStar(13)" onmouseout="unhighlightStar(13)" onclick="calculateRatings(3), permanentHighlight(13)">
                    <img src = "static/img/star.png" class = "Star" id = "Star14" onmouseover="highlightStar(14)" onmouseout="unhighlightStar(14)" onclick="calculateRatings(4), permanentHighlight(14)">
                    <img src = "static/img/star.png" class = "Star" id = "Star15" onmouseover="highlightStar(15)" onmouseout="unhighlightStar(15)" onclick="calculateRatings(5), permanentHighlight(15)">
                </div>
                <div id = "Criteria3">Fun</div>
                <div id = "Fun">
                    <img src = "static/img/star.png" class = "Star" id = "Star16" onmouseover="highlightStar(16)" onmouseout="unhighlightStar(16)" onclick="calculateRatings(1), permanentHighlight(16)">
                    <img src = "static/img/star.png" class = "Star" id = "Star17" onmouseover="highlightStar(17)" onmouseout="unhighlightStar(17)" onclick="calculateRatings(2), permanentHighlight(17)">
                    <img src = "static/img/star.png" class = "Star" id = "Star18" onmouseover="highlightStar(18)" onmouseout="unhighlightStar(18)" onclick="calculateRatings(3), permanentHighlight(18)">
                    <img src = "static/img/star.png" class = "Star" id = "Star19" onmouseover="highlightStar(19)" onmouseout="unhighlightStar(19)" onclick="calculateRatings(4), permanentHighlight(19)">
                    <img src = "static/img/star.png" class = "Star" id = "Star20" onmouseover="highlightStar(20)" onmouseout="unhighlightStar(20)" onclick="calculateRatings(5), permanentHighlight(20)">
                </div>
            </div>
            <h2>Comments</h2>
        </div>
