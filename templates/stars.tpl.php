<?php
    function makeNewRating($id, $rating = 0) {
        ?>
        <style>
            .rating-<?php echo $id ?> {
                margin-bottom: 20px;
                display: flex;
                flex-direction: row-reverse; /* this is the magic */
                justify-content: flex-end;
            }

            .rating-<?php echo $id ?> input {
                display: none;
            }

            .rating-<?php echo $id ?> label {
                font-size: 24px;
                cursor: pointer;
            }
    
            .rating-<?php echo $id ?> label:hover,
            .rating-<?php echo $id ?> label:hover ~ label { /* reason why the stars are in reverse order in the html */
                color: orange;
            }

            .rating-<?php echo $id ?> input:checked ~ label {
                color: orange;
            }
        </style>

        <?php
        echo "<div class='rating-$id'>";
            for ($i = 5; $i >= 1; $i--) {
                if ($i === $rating) {
                    echo "<input type='radio' id='star$i-$id' name='rating-$id' value='$i' checked>";
                    echo "<label for='star$i-$id'>&#9733;</label>";
                } else {
                    echo "<input type='radio' id='star$i-$id' name='rating-$id' value='$i'>";
                    echo "<label for='star$i-$id'>&#9733;</label>";
                }
            }
        echo "</div>";
    }
?>
