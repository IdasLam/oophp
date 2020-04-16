<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice/init", function () use ($app) {
    // init the session for the game.
    $_SESSION = [];

    session_name("diceGame");
    session_start();

    $_SESSION["dice"] = new Ida\Dice\DiceGame();

    var_dump($_SESSION);
    
    return $app->response->redirect("dice/play");
});



// /**
//  * Play the game - status
//  */
$app->router->get("dice/play", function () use ($app) {
    $title = "Guessing game";
    $data = [];

    $app->page->add("dice/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - Dice
 */
$app->router->post("dice/play", function () use ($app) {
    // echo $_SESSION["dice"];
    $_SESSION["dice"]->setGame($_POST["players"], $_POST["dice"]);
    $_SESSION["begin"] = true;

    return $app->response->redirect("dice/play-game");
});

/**
 * Play the game - Dice
 */
$app->router->post("dice/play-game", function () use ($app) {
    if ($_POST["start"]) {
        $_SESSION["begin"] = false;
        $players = intval($_SESSION["dice"]->getPlayers());

        for ($i = 1; $i <= $players; $i++) {
            $_SESSION["dice"]->rollDice("$i", true);
        }

        $playerOrder = $_SESSION["dice"]->getplayerOrder();

        $_SESSION["turns"] = $_SESSION["dice"]->getTurn();
        $_SESSION["dice"]->setCurrentTurn(array_key_first($playerOrder));
    } elseif ($_POST["p1Roll"]) {
        $_SESSION["dice"]->nextRound();
        $_SESSION["dice"]->rollDice("p1");
    } else {
        
    }

    // var_dump($_POST);
    // echo $_SESSION["dice"];
    // $_SESSION["dice"]->setGame($_POST["players"], $_POST["dice"]);
    // $_SESSION["begin"] = true;

    return $app->response->redirect("dice/play-game");
});

/**
 * Play the game - Dice
 */
$app->router->get("dice/play-game", function () use ($app) {
    $title = "Guessing game";
    $players = $_SESSION["dice"]->getPlayers();
    $currentPlayer = $_SESSION["dice"]->getCurrentTurn();
    
    if ($players === null) {
        return $app->response->redirect("dice/play");
    } else {
        // for ($i = 1; $i <= $players; $i++) {

        // }
    }

    $data = [
        "players" => $players ?? "None",
        "dice" => $_SESSION["dice"]->getDice() ?? "None",
        "round" => $_SESSION["dice"]->getRound(),
        "begin" => $_SESSION["begin"],
        "turn" => $_SESSION["turns"] ?? null,
        "currentTurn" => $currentPlayer === "p1" ? "You": $currentPlayer,
        "order" => $_SESSION["dice"]->getplayerOrder() ?? null
    ];

    $app->page->add("dice/play-dice", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
