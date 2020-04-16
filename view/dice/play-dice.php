<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($data);

echo "<h1>Dice 100</h1>";
echo "<p>Round: $round</p>";
echo "<p>players: $players</p>";
echo "<p>begin : $begin</p>";
// echo "<p>begin : $turn</p>";
var_dump($turn);
echo "<br>";
echo "<br>";
echo "order:";
var_dump($order);

echo "<p>current turn : $currentTurn</p>";
// var_dump($currentTurn);
?>
<div class="player_dice">
    <?php
    foreach ($turn as $key => $value) {
        $values = implode(", ", $value);
        if ($currentTurn != "p1") {
            echo "<div>";
        } else {
            echo "<div class=selected>";
        }

        echo "<h2>Player: $key</h2>";
        echo "<p>Rolled: $values</p>";
        echo "</div>";
    } ?>
    <?#php
    // foreach ($order as $key => $value) {
    //     $values = implode(", ", $turn[$key]);
    //     if ($key != "p1") {
    //         echo "<div>";
    //         echo "<h2>Player: $key</h2>";
    //     } else {
    //         echo "<div class=selected>";
    //         echo "<h2>Player: You</h2>";
    //     }
        
    //     echo "<p>Rolled: $values</p>";
    //     echo "</div>";
    // } ?>
</div>

<?php
if ($begin === true) {
?>
<form method="POST">
    <input type="submit" name="start" id="start" required value="Roll For Order">
</form>
</html>
<?php
} else {
    if ($currentTurn === "You") {?>
        <form method="POST">
            <input type="submit" name="start" id="p1Roll" required value="Roll Dice(es)">
            <input type="submit" name="start" id="next" required value="End turn">
        </form>
    <?php
    } else { ?>
    <form method="POST">
        <input type="submit" name="start" id="continue" required value="Continue">
    </form>
    <?php
    }
}
