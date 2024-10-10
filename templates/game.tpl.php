        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
    </head>

    <body>
        <?php
            include 'templates/navbar.tpl.php';
            include 'backend/pastGames.inc.php';
            include 'templates/stars.tpl.php';

            // get game info
            $gameId = $_GET['gameId'];

            $gameSql = 'SELECT name, description, genre, creators, link, trailer, year FROM pastgames WHERE gameId = ?';
            $gamePrepared = $conn->prepare($gameSql);
            $gamePrepared->bind_param('i', $gameId);
            $gamePrepared->execute();
            $gamePrepared->bind_result($name, $desc, $genre, $creators, $link, $trailer, $year);
            $gamePrepared->fetch();
            $gamePrepared->free_result();

            $thumbnail = convertToFileLink($name, $year, 1);

            // get comment info
            $commentSql = 'SELECT pfp, username, `comment` FROM comments LEFT JOIN users ON comments.userId = users.userId WHERE gameId = ?';
            $commentPrepared = $conn->prepare($commentSql);
            $commentPrepared->bind_param('i', $gameId);
            $commentPrepared->execute();
            $commentPrepared->bind_result($commenterPfp, $commenterUsername, $comment);
            $comments = [];
            while ($commentPrepared->fetch()) {
                $comments[] = [
                        'pfp' => $commenterPfp,
                        'username' => $commenterUsername,
                        'text' => $comment,
                    ];
            }
            $commentPrepared->free_result();
            $userEmail = $_SESSION['userEmail'];

            // handle POST requests from the 2 forms below
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ratingOverall = $_POST['rating-overall'];
                $ratingRelated = $_POST['rating-related'];
                $ratingAesthetic = $_POST['rating-aesthetic'];
                $ratingFun = $_POST['rating-fun'];
                $comment = $_POST['comment'];

                $userIdSql = 'SELECT userId FROM users WHERE email = ?';
                $userIdPrepared = $conn->prepare($userIdSql);
                $userIdPrepared->bind_param('s', $userEmail);
                $userIdPrepared->execute();
                $userIdPrepared->bind_result($userId);
                $userIdPrepared->fetch();
                $userIdPrepared->free_result();
                
                $existSql = 'SELECT Id FROM ratings WHERE userId = (SELECT userId FROM users WHERE email = ?) AND gameId = ?';
                $existPrepared = $conn->prepare($existSql);
                $existPrepared->bind_param('si', $userEmail, $gameId);
                $existPrepared->execute();
                $existPrepared->bind_result($exist);
                $existPrepared->fetch();
                $existPrepared->free_result();
                
                if (isset($ratingOverall) && isset($ratingRelated) && isset($ratingAesthetic) && isset($ratingFun)) {
                    if (isset($exist)) {
                        $sql = 'UPDATE ratings SET MainRating = ?, ThemeRating = ?, AestheticRating = ?, FunRating = ? WHERE userId = ? AND gameId = ?';
                        $stmt = prepared_query($conn, $sql, [$ratingOverall, $ratingRelated, $ratingAesthetic, $ratingFun, $userId, $gameId], 'iiiiss');
                        mysqli_stmt_close($stmt);
                    } else {
                        $ratingInsertSql = 'INSERT INTO ratings(userId, gameId, MainRating, ThemeRating, AestheticRating, FunRating) VALUES (?, ?, ?, ?, ?, ?)';
                        $stmt = prepared_query($conn, $ratingInsertSql, [$userId, $gameId, $ratingOverall, $ratingRelated, $ratingAesthetic, $ratingFun], 'ssiiii');
                        mysqli_stmt_close($stmt);
                    }
                }

                if (isset($comment) && $comment != '') {
                    $commentInsertSql = 'INSERT INTO comments(userId, comment, gameId) VALUES (?, ?, ?)';
                    $stmt = prepared_query($conn, $commentInsertSql, [$userId, $comment, $gameId], 'isi');
                    mysqli_stmt_close($stmt);
                }

                header("Location: index.php?filename=game&gameId=$gameId");
                die();
            }
        ?>
        <div class="center">
            <div id='Header'>
                <h1><?php echo htmlspecialchars($name) ?></h1>
                <div><?php echo htmlspecialchars($genre) ?></div>
                <div>Created by <?php echo htmlspecialchars($creators) ?></div>
            </div>
            
            <div id='game-carousel'>
                <?php
                if ($trailer && $thumbnail) {
                    ?>
                    <a href='#' onclick='update()'><div id='startArrow'>&#x2190;</div></a>
                    <?php
                }
                if ($trailer) {
                    ?>
                    <iframe id='trailer' class='thumbnail' src='<?php echo $trailer ?>'></iframe>
                    <?php
                }
                if ($thumbnail) {
                    ?>
                    <img id='thumbnail' class='thumbnail' src='<?php echo $thumbnail ?>'>
                    <?php
                }
                if ($trailer && $thumbnail) {
                    ?>
                    <a href='#' onclick='update()'><div id='endArrow'>&#x2192;</div></a>
                    <script>
                    let trailer = document.getElementById("trailer");
                    let thumbnail = document.getElementById("thumbnail");
                    let leftArrow = document.getElementById("startArrow");
                    let rightArrow = document.getElementById("endArrow");
                
                    let trailerSelected = true;

                    function update() {
                        if (trailerSelected) {
                            leftArrow.style.display = "none";
                            thumbnail.style.display = "none";
                            rightArrow.style.display = "unset";
                            trailer.style.display = "unset";
                        } else {
                            leftArrow.style.display = "unset";
                            thumbnail.style.display = "unset";
                            rightArrow.style.display = "none";
                            trailer.style.display = "none";
                        }
                        trailerSelected = !trailerSelected;
                    }

                    update();
                    </script>
                    <?php
                }
                ?>
            </div>

            <a href="<?php echo $link ?>">
                <div id="gameButton">Play Game</div>
            </a>
        </div>
        
        <div id='Description'><?php echo $desc ?></div>
        
        <div class = "margin">
            <?php
            if (isset($_SESSION['userEmail'])) {
                ?>
                <!-- review form -->
                <form action='<?php echo "index.php?filename=game&gameId=$gameId" ?>' method='POST'>
                    <h2>Rate</h2>
                    <?php
                    $ratingSql = 'SELECT MainRating, ThemeRating, AestheticRating, FunRating FROM ratings WHERE userId = (SELECT userId FROM users WHERE email = ?) AND gameId = ?';
                    $ratingPrepared = $conn->prepare($ratingSql);
                    $ratingPrepared->bind_param('si', $userEmail, $gameId);
                    $ratingPrepared->execute();
                    $ratingPrepared->bind_result($ratingOverall, $ratingRelated, $ratingAesthetic, $ratingFun);
                    $ratingPrepared->fetch();
                    $ratingPrepared->free_result();
                    ?>
                    <!-- name=rating-overall -->
                    <?php makeNewRating('overall', $ratingOverall) ?>
                    <div class = "ratings"> 
                        Relatedness to Theme
                        <div id="related">
                            <!-- name=rating-related -->
                            <?php makeNewRating('related', $ratingRelated) ?>
                        </div>
                        Aesthetic
                        <div id="aesthetic">
                            <!-- name=rating-aesthetic -->
                            <?php makeNewRating('aesthetic', $ratingAesthetic) ?>
                        </div>
                        Fun
                        <div id="fun">
                            <!-- name=rating-fun -->
                            <?php makeNewRating('fun', $ratingFun) ?>
                        </div>
                    </div>
                    <button class='submit' type='submit'>Submit ratings</button>
                </form>

                <!-- comment form -->
                <form action='<?php echo "index.php?filename=game&gameId=$gameId" ?>' method='POST'>
                    <h2>Comments</h2>
                    <label for="commentInput">Create a comment:</label>
                    <!-- name=comment -->
                    <textarea placeholder="Enter a comment" id="commentInput" name="comment"></textarea>
                    <button class='submit' type='submit'>Add Comment</button>
                </form>
                <?php
            } else {
                ?>
                <div class='login-notice'><b>You must log in to leave a review.</b></div>
                <?php
            }
            ?>

            <!-- show all comments -->
            <h2>Reviews</h2>
            <div class="comment-container">
                <?php
                foreach ($comments as $comment) {
                    if ($comment['text'] === '') { continue; }
                    ?>
                    <div class="comment">
                        <div class="commenter">
                            <img class='pfp' src='<?php echo $comment['pfp']?>'>
                            <div><?php echo htmlspecialchars($comment['username']) ?></div>
                        </div>
                        <div><?php echo htmlspecialchars($comment['text']) ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
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
