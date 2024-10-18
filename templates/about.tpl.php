<section class="about">
    <h2 class="header-section">About</h2>
    <div class="container-sub">
        <div class="container-content center-h order-reverse">
            <div class="carousel fade-right paused">
                <?php
                foreach ($pastGames as $year => $games) {
                    foreach ($games as $i => $game) {
                        if (!isset($game['logo'])) {
                            continue;
                        }
                        $thumbnail = $game['logo'];
                    ?>
                    <div class="carousel-item">
                        <img class="carousel-image" src="<?php echo $thumbnail ?>">
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
            <div class="container-text fade-left paused">
                <p class="header-content text-align-left">
                    Join the RVHS Gamejam! This holiday-long event by <b>RdeV</b> showcases
                    student creativity in <b class="white">game design</b>.
                    <b>Learn or enhance</b> your programming skills with your friends
                    through an exciting <b class="white">game jam</b>!
                </p>

            </div>
        </div>
    </div>
    <div class="spacer"></div>

    <div class="container-sub center-items">
        <video class="center-h fade-bottom paused" id="about-video" controls>
            <source src="static/videos/gamejamvid.webm" type="video/webm">
        </video>
        <p class="header-content fade-top paused text-align-left">
            What’s a game jam? A game jam is a <b class="white">competition</b>
            where participants create games based on <b class="white">a specific theme</b>.
        </p>
    </div>
</section>
