<?php

namespace Ida\Overview;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Ida\TextFilter\MyTextFilter;

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
class OverviewController implements AppInjectableInterface
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
        $data = [
            "title" => "Table content | oophp"
        ];

        $this->app->db->connect();
        $sql = "SELECT * FROM content";

        $data["resultset"] = $this->app->db->executeFetchAll($sql);
        $data["slug"] = $this->app->session->get("slug");
        
        $this->app->page->add("overview/index", $data);
        $this->app->session->set("slug", false);

        return $this->app->page->render($data);
    }

    public function indexActionPost() : object
    {
        $add = $this->app->request->getPost("add");
        $edit = $this->app->request->getPost("edit");
        $data = [
            "title" => "Edit content | oophp"
        ];

        $this->app->db->connect();
        
        if ($add) {
            return $this->app->response->redirect("overview/add");
        } elseif ($edit) {
            $this->app->session->set("id", $this->app->request->getPost("id"));
            return $this->app->response->redirect("overview/edit");
        }
        return $this->app->page->render($data);
    }

    public function addActionGet() : object
    {
        $data["title"] = "Add content";
        $data["matchedSlug"] = $this->app->session->get("slug");
        $this->app->session->set("slug", false);

        $this->app->page->add("overview/add", $data);
        return $this->app->page->render($data);
    }

    public function addActionPost() : object
    {
        $this->app->db->connect();

        $title = $this->app->request->getPost("title");
        $path = $this->app->request->getPost("path");
        $slug = $this->app->request->getPost("slug");
        $textfilter = $this->app->request->getPost("textfilter");
        $type = $this->app->request->getPost("type");
        $data = $this->app->request->getPost("data");

        if ($path === "") {
            $sql = "SELECT * FROM content WHERE slug LIKE ?";
            $res = $this->app->db->executeFetchAll($sql, [$slug]);
        } else {
            $sql = "SELECT * FROM content WHERE path LIKE ? OR slug LIKE ?";
            $res = $this->app->db->executeFetchAll($sql, [$path, $slug]);
        }

        if (empty($res)) {
            $sql = 'INSERT INTO `content` (`title`, `path`, `slug`, `filter`, `type`, `data`) 
            VALUES (?, ?, ?, ?, ?, ?)';
            $this->app->db->execute($sql, [$title, $path, $slug, $textfilter, $type, $data]);
            return $this->app->response->redirect("overview");
        } else {
            $this->app->session->set("slug", true);
            return $this->app->response->redirect("overview/add");
        }
    }

    public function editActionGet() : object
    {
        $this->app->db->connect();
        $id = $this->app->session->get("id");
        $sql = "SELECT * FROM content WHERE id LIKE ?";

        $data["resultset"] = $this->app->db->executeFetchAll($sql, [$id]);
        $data["title"] = "Edit content";

        $this->app->page->add("overview/edit", $data);

        return $this->app->page->render($data);
    }

    public function editActionPost() : object
    {
        $this->app->db->connect();

        $edit = $this->app->request->getPost("edit");
        $remove = $this->app->request->getPost("remove");
        $id = $this->app->request->getPost("id");

        
        if ($edit) {
            $slug = $this->app->request->getPost("slug");
            $path = $this->app->request->getPost("path");
            $data = $this->app->request->getPost("data");

            if ($path === "") {
                $sql = "SELECT * FROM
                (SELECT * FROM content WHERE id NOT LIKE ?) AS c
                WHERE slug LIKE ?";
                $res = $this->app->db->executeFetchAll($sql, [$id, $slug]);
            } else {
                $sql = "SELECT * FROM
                (SELECT * FROM content WHERE id NOT LIKE ?) AS c
                WHERE path LIKE ? OR slug LIKE ?";
                $res = $this->app->db->executeFetchAll($sql, [$id, $path, $slug]);
            }

            if (empty($res)) {
                echo "empty";
                $sql = "UPDATE content SET title = ?, path = ?, slug = ?, data = ? WHERE id LIKE ?";
                $title = $this->app->request->getPost("title");
                
                $this->app->db->execute($sql, [$title, $path, $slug, $data, $id]);
            } else {
                $this->app->session->set("slug", true);
                return $this->app->response->redirect("overview");
            }
        } else if ($remove) {
            $date = date("Y-m-d H:i:s");
            $sql = "UPDATE content SET deleted = ? WHERE id LIKE ?";

            $this->app->db->execute($sql, [$date, $id]);
        }
        
        return $this->app->response->redirect("overview");
    }

    public function routeActionGet() : object
    {
        $this->app->db->connect();

        $filter = new MyTextFilter();

        $page = $this->app->request->getGet("page");
        $data["page"] = $page;
        
        if ($page === "index") {
            $sql = "SELECT * FROM content WHERE type = 'page'";
    
            $data["resultset"] = $this->app->db->executeFetchAll($sql);
            $data["title"] = "Pages";
        } elseif ($page === "blog") {
            $path = $this->app->request->getGet("path");
            $data["path"] = $path;

            if ($path === null) {
                $sql = "SELECT * FROM content WHERE type LIKE 'post'";
                $res = $this->app->db->executeFetchAll($sql);
                
                $data["title"] = "Blog";
                $data["resultset"] = $res;
            } else {
                $sql = "SELECT * FROM content WHERE slug LIKE ?";
                $res = $this->app->db->executeFetchAll($sql, [$path]);
                $dataRes = $res[0]->data;
                $filters = explode(",", $res[0]->filter);
    
                foreach ($filters as $filterName) {
                    $dataRes = $filter->parse($dataRes, $filterName);
                }

                $data["resultset"] = $res[0];
                $data["data"] = $dataRes;
            }
        } else {
            $id = $this->app->request->getGet("id");
            
            $sql = "SELECT * FROM content WHERE id LIKE ?";
            $res = $this->app->db->executeFetchAll($sql, [$id]);
            $dataRes = $res[0]->data;
            $filters = explode(",", $res[0]->filter);

            foreach ($filters as $filterName) {
                $dataRes = $filter->parse($dataRes, $filterName);
            }

            $data["resultset"] = $res[0];
            $data["data"] = $dataRes;
            $data["title"] = "All pages";
        }

        $this->app->page->add("overview/pages", $data);

        return $this->app->page->render($data);
    }
}
