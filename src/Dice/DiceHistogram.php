<?php

namespace Ida\Dice;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram implements HistogramInterface
{
    use HistogramTrait;

    /**
     * @var array $serie
     */
    private $serie = [];

    /**
     * Create the histogram (visually)
     * @return line
     */
    public function histogram()
    {   
        $line = [];

        $this->serie = $this->getHistogramSerie();

        foreach($this->serie as $face => $count) {
            $line[] = "$face: $count\n";
        }

        return $line;
    }

    /**
     * Get histogram as original
     * @return serie
     */
    public function getHistogramArray()
    {
        return $this->serie;
    }
}
