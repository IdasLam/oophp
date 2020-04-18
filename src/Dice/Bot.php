<?php

namespace Ida\Dice;

class Bot extends Player
{
    /**
     * @var int $rollCount How many times bot should roll.
     * @var int $maxRoll Maximum time dice can be rolled by bot.
     */
    public $rollCount = 0;
    private $maxRoll = 4;

    /**
     * Randomize rollCount on init
     * @return void
     */
    public function __construct($diceCount)
    {
        parent::__construct($diceCount);
        $this->rollCount = rand(1, $this->maxRoll);
    }

    /**
     * Roll dice for bot
     * @return bool if bot is done rolling
     */
    public function botRoll()
    {
        if ($this->rollCount > 0) {
            parent::roll();
            $this->rollCount -= 1;

            return false;
        }

        return true;
    }

    /**
     * Randomize rollCount
     * @return void
     */
    public function newRollCount()
    {
        $this->rollCount = rand(1, $this->maxRoll);
    }
}
