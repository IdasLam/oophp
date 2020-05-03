<?php

namespace Ida\TextFilter;

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
class TextfilterController implements AppInjectableInterface
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
        $originalbbcode = '
        [b]This[/b] [i]song[/i]
        [url=https://www.youtube.com/watch?v=ObzvA8tx9aA]😉[/url]
        [img]https://cdn.betterttv.net/emote/5b1740221c5a6065a7bad4b5/3x[/img]';
        $originallink = '<p>https://dbwebb.se/</p>';
        $originalmd = file_get_contents(__DIR__ . "../../../view/textfilter/test.md");
        $originalnl2br = "Hello \n Person!";


        $filter = new MyTextFilter();
        $data = [
            "title" => "Textfilter | oophp",
            "origbbcode" => $originalbbcode,
            "afterbbcode" => $filter->parse($originalbbcode, "bbcode"),
            "origlink" => $originallink,
            "afterlink" => $filter->parse($originallink, "link"),
            "origmd" => $originalmd,
            "aftermd" => $filter->parse($originalmd, "markdown"),
            "orignl2br" => $originalnl2br,
            "afternl2br" => $filter->parse($originalnl2br, "nl2br"),
        ];

        $this->app->page->add("textfilter/index", $data);

        return $this->app->page->render($data);
    }
}
