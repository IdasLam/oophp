<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($data);

if (isset($_POST["reset"])) {
    echo "<h1>Guess a new number</h1>";
} else {
    echo "<h1>Guess a number</h1>";
}
echo "<p> Guess a number inbetween 1 and 100, you have " . $tries . " tries left.</p>";

if (isset($answer) && $answer === "correct" || $tries === 0) : ?>
    <form method="post">
        <input type="submit" name="reset" value="Reset Game" class="button">
    </form>
    <?php
else : ?>
    <form method="post">
        <input type="text" name="number" autocomplete="off" autofocus>
        <input type="submit" name="guess" value="Make a Guess" class="button">
        <input type="submit" name="reset" value="Reset Game" class="button">
        <input type="submit" name="cheat" value="Cheat" class="button">
    </form>
    <?php
endif;

if (isset($number)) {
    echo "<h2>Your guess: $number is <mark>$answer</mark></h2>";
} elseif (isset($_POST["reset"])) {
    echo "<h2>Game has been reset</h2>";
}

if ($tries <= 0 || $peak === TRUE && !isset($number)) {
    echo "<p>Answer is $cheat.</p>";
}
?>
</html>
