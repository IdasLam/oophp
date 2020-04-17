<?php

namespace Ida\Dice;

class Player
{
    /**
     * @var int $playerScore Score of player
     * @var int $playerScore Score of player
     */
    private $playerScore = 0;
    private $roundScore = 0;
    private $currentRoll = [];
    private $dice = [];

    public function __construct(int $dice) {
        for ($i = 0; $i < $dice; $i++) {
            $this->dice[] = new Dice();
        }
    }

    public function roll() {
        $this->currentRoll = [];

        foreach ($this->dice as $dice) {
            $this->currentRoll[] = $dice->roll();
        }

        $this->roundScore += in_array(1, $this->currentRoll) ? 0 : array_sum($this->currentRoll);
        return $this->roundScore;
    }

    public function hasRolledOne()
    {
        return in_array(1, $this->currentRoll);
    }

    public function endTurn() {
        $this->playerScore += $this->roundScore;
        $this->roundScore = 0;
    }

    public function getRoll()
    {
        return $this->currentRoll;
    }

    public function resetScore()
    {
        $this->playerScore = 0;
        $this->roundScore = 0;
    }

    public function getScore()
    {
        return $this->playerScore;
    }

    public function getroundScore()
    {
        return $this->roundScore;
    }

    public function resetRoundScore()
    {
        $this->roundScore = 0;
    }
}