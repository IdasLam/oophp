<?php
namespace Ida\Dice;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Dice
{
    /**
     * @var int $sides   Sides of dice.
     */

    private $sides = null;

    /**
     * Constructor to initiate the object with current dice settings,
     * if available. Set dice sides.
     *
     * @param int $sides Sides of dice
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Roll dice
     * @return int random number from 1 to 6 (Default)
     */
    public function roll()
    {
        return rand(1, $this->sides);
    }
}
