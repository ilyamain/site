<?php

namespace App\Helpers;

class Formats
{
    /**
     * Returns formatted money string.
     *
     * @param float $input
     *
     * @return string
     */
    public static function money(float $input)
    {
        return number_format($input, 2, ',', ' ');
    }

    /**
     * Returns formatted Russian date format.
     *
     * @param string $input
     *
     * @return string
     */
    public static function dateRU(string $input)
    {
        $timestamp = strtotime($input);
        return ($timestamp !== false) ? date('d.m.Y (H:i:s)', $timestamp) : $input;
    }
}
