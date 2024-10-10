        <link rel = "stylesheet" href = "static/css/gallery.css">
        <!-- <script src = "static/js/library/gallery.js"></script> -->
    </head>
    
    <body>    
        <?php
            include "templates/navbar.tpl.php";
            include "backend/pastGames.inc.php";
        ?>
        <h1>Last Gamejam's Games</h1>
        <div id = "appendGames">
            <?php
            // sql query to select games from previous year only
            $sql = 'SELECT gameId, name, description, genre, creators, link, year FROM pastgames WHERE year = (SELECT MAX(year) FROM pastgames)';
            $prepared = $conn->prepare($sql);
            $prepared->execute();
            $prepared->bind_result($gameId, $name, $desc, $genre, $creators, $link, $year);
            while ($prepared->fetch()) {
                $thumbnail = convertToFileLink($name, $year, 1);
                ?>
                <div id='appendGame'>
                    <a class='game-logo-container' href='index.php?filename=game&gameId=<?php echo $gameId ?>'>
                        <img class='grid gameLogo' src='<?php echo $thumbnail ?>'>
                    </a>
                    <span class='grid name'><?php echo htmlspecialchars($name) ?></span>
                    <span class='grid creator'><?php echo htmlspecialchars($creators) ?></span>
                    <span class='grid genre'><?php echo htmlspecialchars($genre) ?></span>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
<html>
