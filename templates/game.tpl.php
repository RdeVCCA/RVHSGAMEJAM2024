        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
    </head>

    <body>
        <?php
        function addComment($Comment){
            //finding the number of comments to use to figure out the id
            $sql = 'SELECT COUNT(*) FROM Comments';
            $coun = ($conn ->query($sql))->fetch_all();
            foreach($coun as $cou){
                foreach($cou as $co){
                    $count = $co; //array to string conversion
                }
            }

            $sql = 'INSERT ?, ?, ? INTO Comments';
            $stmt = prepared_query($conn, $sql, [$count, $userEmail, $comment]);
        }
        ?>
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
            <label for = "commentInput">Create a comment:</label>
            <textarea placeholder = "Enter a comment" id = "commentInput" name = "commentInput"></textarea>
            <button onclick = "addComment()">Add Comment</button>

            <?php 
            //require table called Comments with Id, pfp, username and comment

            //find the number of comments
            $sql = 'SELECT COUNT(*) FROM Comments';
            $coun = ($conn ->query($sql))->fetch_all();
            foreach($coun as $cou){
                foreach($cou as $co){
                    $count = $co; //array to string conversion
                }
            }
            
            //insert comments into page from database
            if ($count != 0) {
                foreach(range(0, $count - 1) as $index){
                    $sql_info = 'SELECT pfp, username, comment FROM comments, users WHERE Id = ?';
                
                    $pfp = "";
                    $username = "";
                    $comment = "";

                    $stmt = prepared_query($conn, $sql_info, [$index], 's');
                    $stmt->bind_result($pfp, $username, $comment);
                    $stmt->fetch();
                    mysqli_stmt_close($stmt);

                    echo "<div>";
                        echo "<img src = '$pfp'>";
                        echo "<div>$username</div>";
                        echo "<div>$comment</div>";
                    echo "</div>";
                }
            }
            
            
            ?>
        </div>

<!-- Database instructions
comments(Id, UserEmail, comment, GameName)
*Identify comment through unique id
*Identify the person who gave the comment to retrieve pfp and username
*Identify comment to append to page
*Identify GameName to append to the correct game page

games(Id, Thumbnail, GameName, Author, Genre, Descriptions, GameFiles, Trailer)
*Identify game through unique id
*Identify Thumbnail to append to page
*Identify GameName to append to page
*Identify Author to append to page
*Identify Genre to append to papge
*Identify Descriptions to append to page
*Identify GameFiles for downloading when press 'play game'
*Identify Trailer to append to page

ratings(Id, userEmail, GameName, MainRating, ThemeRating, AestheticRating, FunRating
*Identify ratings through unique id
*Identify who gave the rating to save their rating on the page when they login
*Identify GameName to know which gamepage to save the rating at
*Identify MainRating to save the rating on page and calculate average rating
*Identify ThemeRating to save the rating on page and calculate average theme rating
*Identify AestheticRating to save the rating on page and calculate average aesthetic rating
*Identify FunRating to save the rating on page and calculate average fun rating

users(UserEmail, username, pfp)
*Identify a user based on their email
*Username is used for referring to a user on the page and to append to page
*Identify pfp to append to comment section-->
