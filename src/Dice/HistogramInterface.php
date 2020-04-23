<?php

namespace Ida\Dice;

/**
 * A interface for a classes supporting histogram reports.
 */
interface HistogramInterface
{
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie();

    /**
     * Adds a dot to the number
     * @return void
     */
    public function addFace($face);
}
