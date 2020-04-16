<?php
namespace Ida\Dice;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Dice
{
    /**
     * @var int $sides   Sides of dice.
     * @var int $face   face of dice.
     */

    private $sides = null;
    private $face = null;

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
     */
    public function roll() {
        $this->face = rand(1, $this->sides);
    }

    /**
     * Get face
     * @return face of dice
     */
    public function getFace() {
        return $this->face;
    }



}
