<?php

namespace Ida\Dice;

use Anax\Controller\SampleAppController;
use Anax\Response\ResponseUtility;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class DiceControllerTest extends TestCase
{
    private $controller;
    
    
    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $di->set("app", $app);
    
        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }

    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertStringEndsWith("index", $res);
    }

    /**
     * Call the controller index action.
     */
    public function testInitAction()
    {
        $res = $this->controller->initAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->assertEquals(gettype($res), "object");
    }
}
