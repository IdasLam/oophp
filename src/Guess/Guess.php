<?php
namespace Ida\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var int $tries    Number of tries from the begining.
     */

    private $number = null;
    private $tries = null;
    private $triesTotal = null;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $this->random();
        } else {
            $this->number = $number;
        }
        $this->tries = $tries;
        $this->triesTotal = $tries;
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = mt_rand(1, 100);
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries()
    {
        return $this->tries;
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function getTotalTries()
    {
        return $this->triesTotal;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     * 
     * @param $number get the guess number
     * 
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($number)
    {
        $answer = null;

        try {
            if ($number > 0 && $number <= 100) {
                $this->tries -= 1;
                if ($number === $this->number) {
                    $answer = "correct";
                } elseif ($number > $this->number) {
                    $answer = "too high";
                } elseif ($number < $this->number) {
                    $answer = "too low";
                }
            } else {
                throw new GuessException();
            }
        } catch (GuessException $e) {
            $answer = "not in range.";
            echo "<p><mark>Answer is not in range.</mark></p>";
        }
        return $answer;
    }
}
