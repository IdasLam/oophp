<?php

namespace Ida\Dice;

class Player
{
    /**
     * @var int $playerScore Score of player
     * @var int $roundScore Score of player on current round
     * @var array $currentRoll The dice faces of current roll
     * @var array $dice Array of dice
     */
    private $playerScore = 0;
    private $roundScore = 0;
    private $currentRoll = [];
    private $dice = [];

    /**
     * Create dice
     * @param int $dice Dice count
     */
    public function __construct(int $dice)
    {
        for ($i = 0; $i < $dice; $i++) {
            $this->dice[] = new Dice();
        }
    }

    /**
     * Roll dice
     * @return roundScore this round score
     */
    public function roll()
    {
        $this->currentRoll = [];

        foreach ($this->dice as $dice) {
            $this->currentRoll[] = $dice->roll();
        }

        $this->roundScore += in_array(1, $this->currentRoll) ? 0 : array_sum($this->currentRoll);
        return $this->roundScore;
    }

    /**
     * If player has rolled dice with one on current round
     * @return bool if 1 has been rolled
     */
    public function hasRolledOne()
    {
        return in_array(1, $this->currentRoll);
    }

    /**
     * End player turn
     * @return void
     */
    public function endTurn()
    {
        $this->playerScore += $this->roundScore;
        $this->roundScore = 0;
    }

    /**
     * Get player roll
     * @return currentRoll of the player
     */
    public function getRoll()
    {
        return $this->currentRoll;
    }

    /**
     * Reset playerscore and roundscore
     * @return void
     */
    public function resetScore()
    {
        $this->playerScore = 0;
        $this->roundScore = 0;
    }

    /**
     * Get total score of player
     * @return playerScore the total score
     */
    public function getScore()
    {
        return $this->playerScore;
    }

    /**
     * Get this round score
     * @return roundScore Player score during their turn
     */
    public function getroundScore()
    {
        return $this->roundScore;
    }

    /**
     * Reset roundscore
     * @return void
     */
    public function resetRoundScore()
    {
        $this->roundScore = 0;
    }
}
