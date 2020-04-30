<?php

namespace Ida\Movie;

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
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : object
    {
        $data["title"] = "Movie database | oophp";
        
        $search = $this->app->request->getGet("search") ?? null;
        $this->app->db->connect();

        if ($search && $search != "") {
            $sql = "SELECT * FROM movie WHERE title LIKE ? OR year LIKE ?;";
            $data["resultset"] = $this->app->db->executeFetchAll($sql, ["%$search%", "%$search%"]);
        } else {
            $sql = "SELECT * FROM movie;";
            $data["resultset"] = $this->app->db->executeFetchAll($sql);
        }

        $this->app->page->add("movie/index", $data);

        return $this->app->page->render($data);
    }

    public function indexActionPost() : object
    {
        $add = $this->app->request->getPost("add");
        $edit = $this->app->request->getPost("edit");

        if ($add) {
            return $this->app->response->redirect("movie/add");
        } else if ($edit) {
            $this->app->session->set("id", $this->app->request->getPost("id"));

            return $this->app->response->redirect("movie/edit");
        }
    }

    public function editActionGet() : object
    {
        $this->app->db->connect();
        $id = $this->app->session->get("id");
        $sql = "SELECT * FROM movie WHERE id LIKE ?";

        $data["resultset"] = $this->app->db->executeFetchAll($sql, [$id]);
        $data["title"] = "Edit a movie";

        $this->app->page->add("movie/edit", $data);

        return $this->app->page->render($data);
    }
    
    public function editActionPost() : object
    {
        $this->app->db->connect();
        $edit = $this->app->request->getPost("edit");
        $remove = $this->app->request->getPost("remove");
        $id = $this->app->request->getPost("id");

        if ($edit) {
            $sql = "UPDATE movie SET title = ?, year = ? WHERE id = ?";
            $title = $this->app->request->getPost("title");
            $year = $this->app->request->getPost("year");

            $this->app->db->execute($sql, [$title, $year, $id]);
        } else if ($remove) {
            $sql = "DELETE FROM movie WHERE id = ?";

            $this->app->db->execute($sql, [$id]);
        }
        
        return $this->app->response->redirect("movie");
    }

    public function addActionGet() : object
    {
        $data["title"] = "Add movie";
        $this->app->page->add("movie/add", $data);

        return $this->app->page->render($data);
    }

    public function addActionPost() : object
    {
        $this->app->db->connect();

        $title = $this->app->request->getPost("title");
        $year = $this->app->request->getPost("year");

        $sql = 'INSERT INTO `movie` (`title`, `year`) VALUES (?, ?)';
        $this->app->db->execute($sql, [$title, $year]);
        return $this->app->response->redirect("movie");
    }

    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return string
    //  */
    // public function playgameActionGet() : object
    // {
    //     $title = "Guessing game";

    //     $data = [
    //         "diceGame" => $this->app->session->get("dice")
    //     ];

    //     $this->app->page->add("dice100/play-dice", $data);

    //     return $this->app->page->render([
    //         "title" => $title,
    //     ]);
    // }

    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return string
    //  */
    // public function playgameActionPost() : object
    // {
    //     $diceGame = $this->app->session->get("dice");

    //     if ($this->app->request->getPost("order")) {
    //         $diceGame->setOrder();
    //     } elseif ($this->app->request->getPost("roll")) {
    //         $diceGame->playerRoll();
    //     } elseif ($this->app->request->getPost("endTurn")) {
    //         $diceGame->nextTurn();
    //     } else {
    //         $diceGame->botRoll();
    //     }

    //     return $this->app->response->redirect("dice100/play-game");
    // }
}
