<?php

namespace Ida\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "index";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // init the session for the game.
        $this->app->session->start();

        return $this->app->response->redirect("dice100/play");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Guessing game";
        $data = [];

        $this->app->page->add("dice100/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        $playerCount = intval($this->app->request->getPost("players"));
        $diceCount = intval($this->app->request->getPost("dice"));
        
        var_dump($playerCount, $diceCount);

        $this->app->session->set("dice", new DiceGame($playerCount, $diceCount));

        return $this->app->response->redirect("dice100/play-game");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playgameActionGet() : object
    {
        $title = "Guessing game";

        $data = [
            "diceGame" => $this->app->session->get("dice")
        ];

        $this->app->page->add("dice100/play-dice", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playgameActionPost() : object
    {
        $diceGame = $this->app->session->get("dice");

        if ($this->app->request->getPost("order")) {
            $diceGame->setOrder();
        } elseif ($this->app->request->getPost("roll")) {
            $diceGame->playerRoll();
        } elseif ($this->app->request->getPost("endTurn")) {
            $diceGame->nextTurn();
        } else {
            $diceGame->botRoll();
        }

        return $this->app->response->redirect("dice100/play-game");
    }
}
