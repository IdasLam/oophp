<?php
namespace Ida\Dice;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{
    /**
     * @var int $players   Current players.
     */
    private $players = [];
    private $playerOrder = [];
    private $playerTurn = null;
    private $finishedGame = false;

    public function __construct(int $playerCount, int $diceCount)
    {
        for ($i = 0; $i < $playerCount; $i++) {

            $this->players[$i] = $i > 0 ? new Bot($diceCount) : new Player($diceCount);
        }
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function hasOrder()
    {
        return !empty($this->playerOrder);
    }

    public function playerRoll() {
        $this->players[$this->playerTurn]->roll();
        $rolledOne = $this->players[$this->playerTurn]->hasRolledOne();

        if ($rolledOne) {
            $this->players[$this->playerTurn]->resetRoundScore();
            $this->players[$this->playerTurn]->endTurn();
            $this->nextTurn();
        }
    }

    public function BotRoll() {
        $isDone = $this->players[$this->playerTurn]->BotRoll();
        $rolledOne = $this->players[$this->playerTurn]->hasRolledOne();

        if ($rolledOne || $isDone) {
            $this->players[$this->playerTurn]->endTurn();
            $this->players[$this->playerTurn]->newRollCount();
            $this->nextTurn();
        }
    }

    public function nextTurn() {
        $this->players[$this->playerTurn]->endTurn();
        $playerScore = $this->players[$this->playerTurn]->getScore();

        if ($playerScore >= 100) {
            $this->finishedGame = true;
        } else {
            $index = array_search($this->playerTurn, $this->playerOrder);
    
            if ($index === count($this->playerOrder) - 1) {
                $this->playerTurn = $this->playerOrder[0];
            } else {
                $this->playerTurn = $this->playerOrder[$index + 1];
            }
        }
    }

    public function setOrder()
    {
        $order = [];

        for ($i = 0; $i < count($this->players); $i++) {
            $this->players[$i]->roll();
            $this->players[$i]->resetScore();
            $score = array_sum($this->players[$i]->getRoll());
            
            $order[$i] = $score;
        }

        arsort($order);

        foreach($order as $key => $value) {
            $this->playerOrder[] = $key;
        }

        $this->playerTurn = $this->playerOrder[0];
    }

    public function getOrder() {
        return $this->playerOrder;
    }

    public function getPlayerTurn() {
        return $this->playerTurn;
    }

    public function getfinishedGame() {
        return $this->finishedGame;
    }
}