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
    $app->session->start();

    
    return $app->response->redirect("dice/play");
});



/**
 * Play the game - status
 */
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
    $playerCount = intval($app->request->getPost("players"));
    $diceCount = intval($app->request->getPost("dice"));
    
    var_dump($playerCount, $diceCount);

    $app->session->set("dice", new Ida\Dice\DiceGame($playerCount, $diceCount));

    return $app->response->redirect("dice/play-game");
});

/**
 * Play the game - Dice
 */
$app->router->post("dice/play-game", function () use ($app) {
    $diceGame = $app->session->get("dice");

    if ($app->request->getPost("order")) {
        $diceGame->setOrder();
    } elseif ($app->request->getPost("roll")) {
        $diceGame->playerRoll();
    } elseif ($app->request->getPost("endTurn")) {
        $diceGame->nextTurn();
    } else {
        $diceGame->BotRoll();
    }

    return $app->response->redirect("dice/play-game");
});

/**
 * Play the game - Dice
 */
$app->router->get("dice/play-game", function () use ($app) {
    $title = "Guessing game";

    $data = [
        "diceGame" => $app->session->get("dice")
    ];

    $app->page->add("dice/play-dice", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
