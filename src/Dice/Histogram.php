<?php

namespace Ida\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var array $histogram  the histogram in "array form".
     */
    private $serie = [];
    private $histogram;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->histogram;
    }

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object, $face)
    {
        $object->addFace($face);
        $this->histogram = $object->histogram();
        $this->serie = $object->getHistogramArray();
    }
}
