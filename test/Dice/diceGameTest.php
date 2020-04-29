<?php

namespace Ida\Dice;

use PHPUnit\Framework\TestCase;

class DiceGameTest extends TestCase
{
    /**
     * Test to init 4 players, see if all 4 players exsist
     */
    public function testConstruct()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);

        $res = count($game->getPlayers());
        $exp = 4;

        $this->assertEquals($exp, $res);
    }

    /**
     * Test to set order, check if it is set
     */
    public function testSetOrderr()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);

        $notSet = $game->hasOrder();
        $game->setOrder();
        $set = $game->hasOrder();

        $this->assertNotEquals($notSet, $set);
    }

    /**
     * Test to set order, if first player in order is correct
     */
    public function testSetOrderPlayer()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);

        $game->setOrder();
        $order = $game->getOrder();
        $firstPlayer = $game->getPlayerTurn();

        $this->assertEquals($order[0], $firstPlayer);
    }
    
    /**
     * Test if game is finished
     */
    public function testGetFinishedGame()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        $finished = $game->getFinishedGame();
        
        $exp = false;
        $this->assertEquals($exp, $finished);
    }
    
    /**
     * Test player roll, not rolled one
     */
    public function testPlayerRoll()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        $game->setOrder();
        
        $current = $game->getPlayerTurn();
        
        function reDo($current, $game)
        {
            while ($current != 0) {
                $game->nextTurn();
                $current = $game->getPlayerTurn();
            }
            
            $game->playerRoll();
            return [$game->getPlayerTurn(), $current];
        }

        $player = reDo($current, $game);
        while ($player[0] != 0) {
            $player = reDo($current, $game);
        }
        
        $this->assertEquals($player[0], $player[1]);
    }
    
    /**
     * Test player roll, rolled one
     */
    public function testPlayerRoll2()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        $game->setOrder();
        
        $current = $game->getPlayerTurn();
        
        function reDo2($current, $game)
        {
            while ($current != 0) {
                $game->nextTurn();
                $current = $game->getPlayerTurn();
            }
            
            $game->playerRoll();
            return [$game->getPlayerTurn(), $current];
        }

        $player = reDo2($current, $game);
        while ($player[0] === 0) {
            $player = reDo2($current, $game);
        }
        
        $this->assertNotEquals($player[0], $player[1]);
    }

    /**
     * Test bot roll, not rolled one
     */
    public function testBotRoll()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        $game->setOrder();
        
        $current = $game->getPlayerTurn();
        
        function reRoll($current, $game)
        {
            while ($current === 0) {
                $game->nextTurn();
                $current = $game->getPlayerTurn();
            }
            
            $game->BotRoll();
            return [$game->getPlayerTurn(), $current];
        }

        $player = reRoll($current, $game);
        while ($player[0] === 0) {
            $player = reRoll($current, $game);
        }
        
        $this->assertEquals($player[0], $player[1]);
    }

    /**
     * Test bot roll, rolled one
     */
    public function testBotRoll2()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        $game->setOrder();
        
        $current = $game->getPlayerTurn();
        
        function reDo3($current, $game)
        {
            while ($current === 0) {
                $game->nextTurn();
                $current = $game->getPlayerTurn();
            }
            
            $game->botRoll();
            return [$game->getPlayerTurn(), $current];
        }

        $player = reDo3($current, $game);
        while ($player[0] != 0) {
            $player = reDo3($current, $game);
        }
        $this->assertNotEquals($player[0], $player[1]);
    }

    /**
     * test get histogram
     */
    public function testgetHistogram()
    {
        $game = new DiceGame(4, 1);
        $this->assertInstanceOf("\Ida\Dice\DiceGame", $game);
        
        $res = $game->getHistogram();
        $exp = null;

        $this->assertEquals($res, $exp);
    }
}
