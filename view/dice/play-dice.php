<?php

namespace Anax\View;

$players = $diceGame->getPlayers();
$playerTurn = $diceGame->getPlayerTurn();
$finishedGame = $diceGame->getFinishedGame();
?>

<h1>Dice game 100</h1>

<?php if (!$finishedGame) : ?>
    <?php if (!$diceGame->hasOrder()) :?>
    <form action="" method="post">
        <input type="submit" name="order" value="Roll for order">
    </form>
    <?php endif; ?> 

    <div class="player_dice">
    <?php for ($i = 0; $i < count($players); $i++) : ?>
        <?php if ($playerTurn === $i) : ?>
        <div class="selected">
        <?php else : ?>
        <div>
        <?php endif; ?>
            <h2>Player <?= $i + 1 ?></h2>
            <p>Player total score: <?= $players[$i]->getScore() ?></p>
            <p>Player round score: <?= $players[$i]->getRoundScore() ?></p>
            <p><?= implode(", ", $players[$i]->getRoll()) ?></p>
        </div>
    <?php endfor; ?>
    </div>

    <?php if ($playerTurn === 0) : ?>
    <form method="post">
        <input type="submit" name="roll" value="Roll dice">
        <input type="submit" name="endTurn" value="End turn">
    </form>
    <?php elseif ($playerTurn != null) : ?>
    <form method="post">
        <input type="submit" name="continue" value="continue">
    </form>
    <?php endif; ?>

<?php else : ?>
<h2>The Winner is Player <?= $playerTurn + 1?></h2>
<a href="init">Play again?</a>
<?php endif; ?>
