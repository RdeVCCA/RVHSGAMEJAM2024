        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
    </head>

    <body>
        <?php
        error_reporting(E_ERROR | E_PARSE);
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
            mysqli_stmt_close($stmt);
        }

        $gameId = $_GET['game'];
        $_SERVER['gameId'] = $gameId;

        $sql = 'SELECT gameName FROM games where Id = ?';

        $gameName = "";

        $stmt = prepared_query($conn, $sql, [$gameId], 's');
        $stmt->bind_result($gameName);
        $stmt->fetch();
        mysqli_stmt_close($stmt);

        $_SERVER['gameName'] = $gameName;
        $gameName = $_SERVER['gameName'];


        $sql = 'SELECT COUNT(*) FROM ratings WHERE UserEmail = ? AND gameName = ?';
        
        $exist = '';
        
        $userEmail = 'liou_larissa@students.edu.sg'; //to replace with actual login
        
        $stmt = prepared_query($conn, $sql, [$userEmail, $gameName], 'ss');
        $stmt->bind_result($exist);
        $stmt->fetch();
        mysqli_stmt_close($stmt);

        $sql = 'SELECT GameFiles FROM games WHERE GameName = ?';
                    
        $GameFiles = '';

        $stmt = prepared_query($conn, $sql, [$gameName], 's');
        $stmt->bind_result($GameFiles);
        $stmt->fetch();
        mysqli_stmt_close($stmt);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ratings = $_POST['R'];
            $comments = $_POST['comment'];
            
            if ($ratings != ''){
                if ($exist == 1){
                    $sql = 'UPDATE ratings SET MainRating = ?, ThemeRating = ?, AestheticRating = ?, FunRating = ? WHERE UserEmail = ? AND gameName = ?';
                    
                    $stmt = prepared_query($conn, $sql, [$ratings[0], $ratings[1], $ratings[2], $ratings[3], $userEmail, $gameName], 'ssssss');
                    mysqli_stmt_close($stmt);
                } else{
                    $sql = 'SELECT COUNT(*) FROM ratings';
                    $coun = ($conn ->query($sql))->fetch_all();
                        foreach($coun as $cou){
                            foreach($cou as $co){
                                $count = $co; //array to string conversion
                            }
                        }
        
                    $sql = 'INSERT INTO ratings VALUES (?, ?, ?, ?, ?, ?, ?)';
                    
                    $stmt = prepared_query($conn, $sql, [$count, $userEmail, $gameName, $ratings[0], $ratings[1], $ratings[2], $ratings[3]], 'sssssss');
                    mysqli_stmt_close($stmt);
                }
            }
            if ($comments != ''){
                $sql = 'SELECT COUNT(*) FROM comments';
                $coun = ($conn ->query($sql))->fetch_all();
                    foreach($coun as $cou){
                        foreach($cou as $co){
                            $count = $co; //array to string conversion
                        }
                    }
                $sql = 'INSERT INTO comments VALUES (?, ?, ?, ?)';
                
                $stmt = prepared_query($conn, $sql, [$count + 1, $userEmail, $comments, $gameName], 'ssss');
                mysqli_stmt_close($stmt);
            }

        
        }
        ?>
            
        <?php
        $sql = 'SELECT MainRating, ThemeRating, AestheticRating, FunRating from Ratings WHERE UserEmail = ? AND gameName = ?';
        $stmt = prepared_query($conn, $sql, [$userEmail, $gameName], 'ss');

        $mainRating = '';
        $themeRating = '';
        $aestheticRating = '';
        $funRating = '';

        $stmt->bind_result($mainRating, $themeRating, $aestheticRating, $funRating);
        $stmt->fetch();
        mysqli_stmt_close($stmt);

        ?>

        <div class = "center">
            <?php 
            //retrieving information from database about game based on gameId transferred through get variable
            
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

            if ($Trailer != ''){
                $Trailer = explode("[", $Trailer); //splitting different image or video links with [ to separate them into an arrays
            } else{
                $Trailer = array();
            }

            $PV_index = 0;
            if ($Trailer != ''){
                array_unshift($Trailer, $Thumbnail);
            }

            $PV_index = $_GET['PV']; //making the buttons change the PV_index to swtich image or video
            if ($PV_index != 0){
                $PV_indexl = $PV_index - 1;
            } else{
                $PV_indexl = $PV_index;
            }
            if ($PV_index < sizeof($Trailer) - 1){
                $PV_indexg = $PV_index + 1;
            } else{
                $PV_indexg = $PV_index;
            }

            echo "<div id = 'Header'>";
                echo "<h1>$GameName</h1>";
                echo "<div>$Genre</div>";
                echo "<div>Created by $Author</div>";
            echo "</div>"; 
            
            echo "<div id = 'T_V'>";
                echo "<a href = 'index.php?filename=game&game=$gameId&PV=$PV_indexl'><div id = 'startArrow'>&#x2190;</div></a>";
                if ($Trailer[$PV_index][0] == 'h'){ //if the display is a video
                    echo "<iframe width='560' height='315' src = '$Trailer[$PV_index]'></iframe>"; //to prevent error in playing the video, for youtube video, find it, share, embed and copy link
                } else{
                    echo "<img src = '$Trailer[$PV_index]'>"; //if the display is an image
                }
                echo "<a href = 'index.php?filename=game&game=$gameId&PV=$PV_indexg'><div id = 'endArrow'> &#x2192;</div></a>";
            echo "</div>"
            ?>

            <a href = "<?php echo $GameFiles;?>"><div id = "gameButton">Play Game</div></a>
        </div>
        <?php
        echo "<div id = 'Description'>$Descriptions</div>";
        ?>
        <div class = "margin">
            <?php
            echo "<form action = 'index.php?filename=game&game=$gameId&PV=$PV_index' method = 'POST'>"
            ?>
                <h2>Rate</h2>
                <img src = "static/img/star.png" class = "Stars" id = "Star1" onmouseover="highlightStar(1)" onmouseout="unhighlightStar(1)" onclick="permanentHighlight(1), calculateRatings(1)">
                <img src = "static/img/star.png" class = "Stars" id = "Star2" onmouseover="highlightStar(2)" onmouseout="unhighlightStar(2)" onclick="permanentHighlight(2), calculateRatings(2)">
                <img src = "static/img/star.png" class = "Stars" id = "Star3" onmouseover="highlightStar(3)" onmouseout="unhighlightStar(3)" onclick="permanentHighlight(3), calculateRatings(3)">
                <img src = "static/img/star.png" class = "Stars" id = "Star4" onmouseover="highlightStar(4)" onmouseout="unhighlightStar(4)" onclick="permanentHighlight(4), calculateRatings(4)">
                <img src = "static/img/star.png" class = "Stars" id = "Star5" onmouseover="highlightStar(5)" onmouseout="unhighlightStar(5)" onclick="permanentHighlight(5), calculateRatings(5)">
                <div class = "ratings"> 
                    <div id = "Criteria1">Relatedness to Theme</div>
                    <div id = "Theme">
                        <img src = "static/img/star.png" class = "Star" id = "Star6" onmouseover="highlightStar(6)" onmouseout="unhighlightStar(6)" onclick=" permanentHighlight(6), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star7" onmouseover="highlightStar(7)" onmouseout="unhighlightStar(7)" onclick="permanentHighlight(7), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star8" onmouseover="highlightStar(8)" onmouseout="unhighlightStar(8)" onclick="permanentHighlight(8), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star9" onmouseover="highlightStar(9)" onmouseout="unhighlightStar(9)" onclick="permanentHighlight(9), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star10" onmouseover="highlightStar(10)" onmouseout="unhighlightStar(10)" onclick="permanentHighlight(10), calculateRatings(5)">
                    </div>
                    <div id = "Criteria2">Aesthetic</div>
                    <div id = "Aesthetic">
                        <img src = "static/img/star.png" class = "Star" id = "Star11" onmouseover="highlightStar(11)" onmouseout="unhighlightStar(11)" onclick="permanentHighlight(11), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star12" onmouseover="highlightStar(12)" onmouseout="unhighlightStar(12)" onclick="permanentHighlight(12), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star13" onmouseover="highlightStar(13)" onmouseout="unhighlightStar(13)" onclick="permanentHighlight(13), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star14" onmouseover="highlightStar(14)" onmouseout="unhighlightStar(14)" onclick="permanentHighlight(14), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star15" onmouseover="highlightStar(15)" onmouseout="unhighlightStar(15)" onclick="permanentHighlight(15), calculateRatings(5)">
                    </div>
                    <div id = "Criteria3">Fun</div>
                    <div id = "Fun">
                        <img src = "static/img/star.png" class = "Star" id = "Star16" onmouseover="highlightStar(16)" onmouseout="unhighlightStar(16)" onclick="permanentHighlight(16), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star17" onmouseover="highlightStar(17)" onmouseout="unhighlightStar(17)" onclick="permanentHighlight(17), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star18" onmouseover="highlightStar(18)" onmouseout="unhighlightStar(18)" onclick="permanentHighlight(18), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star19" onmouseover="highlightStar(19)" onmouseout="unhighlightStar(19)" onclick="permanentHighlight(19), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star20" onmouseover="highlightStar(20)" onmouseout="unhighlightStar(20)" onclick="permanentHighlight(20), calculateRatings(5)">
                    </div>
                    <input type = 'hidden' id = 'currentRatings' name = 'R'>
                    <button class = 'submit' type = 'submit'>Submit ratings</button>
                </div>
            </form>
        <?php
            echo "<form action = 'index.php?filename=game&game=$gameId&PV=$PV_index' method = 'POST'>"
        ?>
                <h2>Comments</h2>
                <label for = "commentInput">Create a comment:</label>
                <textarea placeholder = "Enter a comment" id = "commentInput" name = "comment"></textarea>
                <button class = 'submit' type = 'submit'>Add Comment</button>
            </form>
        

        <?php 
        //require table called Comments with Id, pfp, username and comment

        //find the number of comments
        $count = '';

        $sql = 'SELECT COUNT(*) FROM comments WHERE GameName = ?';
        $stmt = prepared_query($conn, $sql, [$gameName], 's');
        $stmt->bind_result($count);
        $stmt->fetch();
        mysqli_stmt_close($stmt);
        
        //insert comments into page from database
        if ($count != 0) {
            foreach(range(1, $count) as $index){
                $sql_info = 'SELECT pfp, username, comment, GameName FROM comments, users WHERE id = ?';
            
                $pfp = "";
                $username = "";
                $comment = "";
                $Gamename = "";

                $stmt = prepared_query($conn, $sql_info, [$index], 's');
                $stmt->bind_result($pfp, $username, $comment, $Gamename);
                $stmt->fetch();
                mysqli_stmt_close($stmt);

                if ($gameName == $Gamename){
                    echo "<div>";
                        echo "<img class = 'inline' id = 'pfp' src = '$pfp'>";
                        echo "<div class = 'inline'>$username</div>";
                        echo "<div>$comment</div>";
                    echo "</div>";
                }
            }
        }
        ?>
        </div>
        <script>
            if (<?php echo $mainRating?> != ''){
                    for(let i = 1; i< <?php echo $mainRating; ?> + 1; i++){
                    console.log(i)
                    document.getElementById("Star" + i).src = "static/img/ColoredStar.png"
                }
                for(let i = 6; i< <?php echo $themeRating; ?> + 6; i++){
                    document.getElementById("Star" + i).src = "static/img/ColoredStar.png"
                }
                for(let i = 11; i< <?php echo $aestheticRating; ?> + 11; i++){
                    document.getElementById("Star" + i).src = "static/img/ColoredStar.png"
                }
                for(let i = 16; i< <?php echo $funRating; ?> + 16; i++){
                    document.getElementById("Star" + i).src = "static/img/ColoredStar.png"
                }
                var highlighted1 = true
                var highlighted2 = true
                var highlighted3 = true
                var highlighted4 = true
                var permanentNumber1 = <?php echo $mainRating; ?>;
                var permanentNumber2 = (<?php echo $themeRating; ?> + 5);
                var permanentNumber3 = <?php echo $aestheticRating; ?> + 10;
                var permanentNumber4 = <?php echo $funRating; ?> + 15;
                console.log('yees')
            } else{
                console.log('hi')
                var highlighted1 = false
                var highlighted2 = false
                var highlighted3 = false
                var highlighted4 = false
                var permanentNumber1 = 0
                var permanentNumber2 = 0
                var permanentNumber3 = 0
                var permanentNumber4 = 0
            }
            
        </script>
    </body>
</html>

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
*Includes Trailer and pictures of gameplay to append on game page

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
