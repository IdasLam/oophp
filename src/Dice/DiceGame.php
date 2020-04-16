<?php
namespace Ida\Dice;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{
    /**
     * @var int $players   Current players.
     * @var int $dice      Dices.
     * @var int $round     rounds.
     * @var int $turn     Turn.
     * @var int $playerOrder     Order of players.
     * @var int $currentTurn     Whos turn.
     * @var int $points    Players points.
     */

    private $players = null;
    private $dice = [];
    private $round = 0;
    private $turn = [];
    private $playerOrder = [];
    private $currentTurn = null;
    private $points = [];

    /**
     * Set players count
     * @param int $count The player count. Default 2.
     * @param int $dice  Dices. Default 1.
     */
    public function setGame(int $count = 2, int $dice = 1)
    {
        $this->players = $count;

        for ($i = 1; $i <= $dice; $i++) {
            $this->dice[] = new Dice();
        }
    }

    /**
     * Set players turn
     * @param int $player The player.
     */
    public function setTurn(int $player)
    {   
        $playerName = "$player";

        if (empty($this->turn)) {
            $this->currentTurn = $playerName;
        }

        array_push($this->turn, $playerName);
    }

    /**
     * Roll dice for a player
     * @param player
     */
    public function rollDice($player, $start = false) {
        $rolls = [];
        $dices = count($this->dice);
        
        for ($i = 0; $i < $dices; $i++) {
            $this->dice[$i]->roll();
            $face = $this->dice[$i]->getFace();
            $rolls[] = $face;
        }
        
        if ($start === true) {
            $sum = 0;
            foreach ($rolls as $face) {
                $sum += $face;
            }

            $this->playerOrder["p$player"] = $sum;

            $this->turn["p$player"] = $rolls;
        } else {
            $this->turn = [];

            $this->turn[$player] = $rolls;
        }
    }
    
    
    
    /**
     * Get playerOrder, and sort by highest key
     * @return int as playerOrder 
     */
    public function getplayerOrder()
    {
        arsort($this->playerOrder);
        return $this->playerOrder;
    }

    /**
     * Get turn, and sort by highest key
     * @return int as turn 
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Set current turn
     * @param player the player turn
     */
    public function setOrder($player)
    {
        $this->currentTurn = $player;
    }

    /**
     * Set current turn
     * @param player the player turn
     */
    public function setCurrentTurn($player)
    {
        $this->currentTurn = $player;
    }

    /**
     * Get current turn
     * @return player
     */
    public function getCurrentTurn()
    {
        return $this->currentTurn;
    }

    /**
     * Get players count
     * @return int as players count 
     */
    public function getPlayers()
    {
        return $this->players;
    }
    
    /**
     * Get dice count
     * @return int as dice count 
     */
    public function getDice()
    {
        return $this->dice;
    }
    
    /**
     * Get round
     * @return int as round 
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Set round
     */
    public function nextRound()
    {
        $this->round += 1;
    }

}