<?php

namespace Ida\Dice;

class Bot extends Player
{
    public $rollCount = 0;
    private $maxRoll = 4;

    public function __construct($diceCount)
    {
        parent::__construct($diceCount);
        $this->rollCount = rand(1, $this->maxRoll);
    }

    public function BotRoll()
    {
        if ($this->rollCount > 0) {
            parent::roll();
            $this->rollCount -= 1;

            return false;
        }

        return true;
    }

    public function newRollCount()
    {
        $this->rollCount = rand(1, $this->maxRoll);
    }
}
