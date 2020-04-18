<?php
namespace Ida\Dice;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{
    /**
     * @var int $players   Current players.
     * @var int $playerOrder   Order to play.
     * @var int $playerTurn   Which players turn.
     * @var int $finishedGame   If game is finished.
     */
    private $players = [];
    private $playerOrder = [];
    private $playerTurn = null;
    private $finishedGame = false;

    /**
     * Initialise player and bots
     * @param int $playerCount Player count
     * @param int $diceCount Dice count
     */
    public function __construct(int $playerCount, int $diceCount)
    {
        for ($i = 0; $i < $playerCount; $i++) {

            $this->players[$i] = $i > 0 ? new Bot($diceCount) : new Player($diceCount);
        }
    }

    /**
     * Get players
     * @return players
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * If order has been decided
     * @return bool
     */
    public function hasOrder()
    {
        return !empty($this->playerOrder);
    }

    /**
     * Roll players dice, if player rolled one then end the turn
     * @return void
     */
    public function playerRoll() {
        $this->players[$this->playerTurn]->roll();
        $rolledOne = $this->players[$this->playerTurn]->hasRolledOne();

        if ($rolledOne) {
            $this->players[$this->playerTurn]->resetRoundScore();
            $this->players[$this->playerTurn]->endTurn();
            $this->nextTurn();
        }
    }

    /**
     * Roll dice for bot, if rolled one then end turn
     * @return void
     */
    public function botRoll() {
        $isDone = $this->players[$this->playerTurn]->botRoll();
        $rolledOne = $this->players[$this->playerTurn]->hasRolledOne();

        if ($rolledOne || $isDone) {
            $this->players[$this->playerTurn]->endTurn();
            $this->players[$this->playerTurn]->newRollCount();
            $this->nextTurn();
        }
    }

    /**
     * Next turn for player when they dont want to roll again.
     * @return void
     */
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

    /**
     * Roll dice for every player in game to decide order.
     * @return void
     */
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

    /**
     * Get the order of the players
     * @return playerOrder
     */
    public function getOrder() {
        return $this->playerOrder;
    }

    /**
     * Get the current player name of the turn
     * @return void
     */
    public function getPlayerTurn() {
        return $this->playerTurn;
    }

    /**
     * Get status of game
     * @return finishedGame
     */
    public function getFinishedGame() {
        return $this->finishedGame;
    }
}