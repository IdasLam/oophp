<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
// var_dump($data);

echo "<h1>Dice 100</h1>";


?>
<form method="POST">
    <label for="players">How many players?</label>
    <input type="number" name="players" min="2" max="5" required>

    <label for="players">How many dices?</label>
    <input type="number" name="dice" min="1" max="5" required>
    <button>Play!</button>
</form>
</html>
