<?php

namespace Ida\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int $min  The lowest number on dice.
     * @var int $max  The highest number on dice.
     */
    private $serie = [];
    private $min = 1;
    private $max = 6;

    /**
     * Adds a dot to the number
     * @return void
     */
    public function addFace($face)
    {
        foreach ($face as $roll => $value) {
            if (isset($this->serie[$value])) {
                $this->serie[$value] .= "*";
            } else {
                $this->serie[$value] = "*";
            }
        }
        
        for ($i = $this->min; $i <= $this->max; $i++) {
            if (!array_key_exists($i, $this->serie)) {
                $this->serie[$i] = "";
            }
        }

        ksort($this->serie);
    }

    /**
     * Get the serie
     * @return serie
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }
}
