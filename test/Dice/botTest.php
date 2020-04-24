<?php

namespace Ida\Dice;

use PHPUnit\Framework\TestCase;

class BotTest extends TestCase
{
    /**
     * Test if construct sets new rollCount
     */
    public function testConstruct()
    {
        $bot = new Bot(3);
        $this->assertInstanceOf("\Ida\Dice\bot", $bot);
        $res = $bot->rollCount;

        $this->assertGreaterThan(0, $res);
    }

    /**
     * Test botRoll, when rolls left
     */
    public function testBotRoll()
    {
        $bot = new Bot(3);
        $this->assertInstanceOf("\Ida\Dice\bot", $bot);
        $bot->rollCount = 3;

        $res = $bot->botRoll();
        $exp = false;

        $this->assertEquals($exp, $res);
    }

    /**
     * Test botRoll, when no rolls left
     */
    public function testBotRoll2()
    {
        $bot = new Bot(3);
        $this->assertInstanceOf("\Ida\Dice\bot", $bot);
        $bot->rollCount = 1;

        $bot->botRoll();
        $res = $bot->botRoll();
        $exp = true;

        $this->assertEquals($exp, $res);
    }

    /**
     * Test to roll new rollCount
     */
    public function testNewRollCount()
    {
        $bot = new Bot(3);
        $this->assertInstanceOf("\Ida\Dice\bot", $bot);
        $oldCount = 0;
        $bot->rollCount = $oldCount;

        $bot->newRollCount();
        $newCount = $bot->rollCount;

        $this->assertNotEquals($oldCount, $newCount);
    }

    /**
     * Test to roll new rollCount, carfull
     */
    public function testNewRollCountCarefull()
    {
        $bot = new Bot(1);
        $this->assertInstanceOf("\Ida\Dice\bot", $bot);
        $oldCount = 0;
        $bot->rollCount = $oldCount;

        $bot->newRollCountCarefull();
        $newCount = $bot->rollCount;

        $this->assertNotEquals($oldCount, $newCount);
    }
}
