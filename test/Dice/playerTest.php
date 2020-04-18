<?php

namespace Ida\Dice;

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /**
     * Init player with 3 dice, then roll
     */
    public function testRoll()
    {
        $player = new Player(3);
        $player->roll();
        $this->assertInstanceOf("\Ida\Dice\Player", $player);

        $res = count($player->getRoll());
        $exp = 3;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test if player rolled one
     */
    public function testhasRollOne()
    {
        $player = new Player(3);
        $player->roll();
        $this->assertInstanceOf("\Ida\Dice\Player", $player);

        $res = getType($player->hasRolledOne());
        $exp = getType(true);
        $this->assertEquals($exp, $res);
    }

    /**
     * Test end turn
     */
    public function testEndTurn()
    {
        $player = new Player(3);
        $this->assertInstanceOf("\Ida\Dice\Player", $player);
        $player->roll();
        $sumRound = $player->getRoundScore();
        $player->endTurn();
        $totalPoints = $player->getScore();

        $this->assertEquals($sumRound, $totalPoints);
    }

    /**
     * Test reset roundScore
     */
    public function testResetRoundScore()
    {
        $player = new Player(3);
        $this->assertInstanceOf("\Ida\Dice\Player", $player);
        $player->roll();
        $player->endTurn();
        $totalPoints = $player->getScore();
        
        while ($totalPoints === 0) {
            $player->roll();
            $totalPoints = $player->getScore();
            $player->endTurn();
        }

        $player->resetRoundScore();
        $sumRound = $player->getRoundScore();

        $this->assertNotEquals($sumRound, $totalPoints);
    }

    /**
     * Test reset all score
     */
    public function testResetScore()
    {
        $player = new Player(3);
        $this->assertInstanceOf("\Ida\Dice\Player", $player);
        $player->roll();
        $player->resetScore();
        $sumRound = $player->getRoundScore();
        $totalPoints = $player->getScore();

        $this->assertEquals($sumRound, $totalPoints);
    }
}
