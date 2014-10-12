<?php


if (function_exists('get_markers')) {
    function get_markers()
    {

    }
}


if (!function_exists('in_array_r')) {

    /**
     * Recursive in_array function.
     *
     * Used in getting available timeslots.
     *
     * @param $needle
     * @param $haystack
     * @param bool $strict
     * @return bool
     */
    function  in_array_r($needle, $haystack, $strict = false)
    {

        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}

