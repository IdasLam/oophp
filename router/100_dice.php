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

    session_name("dice");
    session_start();

    if (!isset($_SESSION["player"])) {
        $_SESSION["player"] = new Ida\Dice\Dice();
    }
    
    return $app->response->redirect("dice/play");
});



// /**
//  * Play the game - status
//  */
$app->router->get("dice/play", function () use ($app) {
    $title = "Guessing game";
    // $answer = $_SESSION["answer"] ?? null;
    // $tries =  $_SESSION["player"]->getTotalTries() ?? $_SESSION["player"]->tries();
    // $_SESSION["tries"] = $_SESSION["player"]->tries();
    // $cheat = $_SESSION["player"]->number();
    // $data = [
    //     "cheat" => $cheat,
    //     "tries" => $_SESSION["tries"],
    //     "answer" => $answer,
    //     "number" => $_SESSION["guess"] ?? null,
    //     "peak" => $_SESSION["peak"] ?? false,
    // ];
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
    // if (isset($_POST["reset"])) {
    //     session_destroy();
    //     return $app->response->redirect("guess/init");
    //     // $_SESSION["totalTries"] =  $_SESSION["player"]->getTotalTries();
    // }
    
    // if (isset($_POST["guess"]) && $_SESSION["tries"] > 0) {
    //     $number = intval($_POST["number"]);
    //     $_SESSION["answer"] = $_SESSION["player"]->makeGuess($number);
    //     $_SESSION["guess"] = $number;
    // } else {
    //     $_SESSION["guess"] = null;
    // }

    // if (isset($_POST["cheat"])) {
    //     $_SESSION["peak"] = true;
    // }

    return $app->response->redirect("dice/play");
});
