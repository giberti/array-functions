<?php

if (!function_exists('array_fingerprint')) {
    /**
     * Creates a fingerprint of the provided data
     *
     * @param array $array An array of values that can be json_encoded
     *
     * @return string
     */
    function array_fingerprint(array $array)
    {
        return md5(json_encode($array));
    }
}

if (!function_exists('array_mean')) {
    /**
     * Returns the mean (average) for the provided array
     *
     * @param array $array An array of numeric values
     *
     * @return float|int
     *
     * @throws Exception
     */
    function array_mean(array $array)
    {
        $count = count($array);
        if (!$count) {
            throw new Exception('Division by zero');
        }

        return array_sum($array) / $count;
    }
}

if (!function_exists('array_variance')) {
    /**
     * Caclulates the variance for the provide array values
     *
     * @param array $array An array of numeric values
     * @param bool $sample Pass true if the set is a sample, false otherwise
     *
     * @return float|int
     *
     * @throws Exception
     */
    function array_variance(array $array, bool $sample = true)
    {
        if (1 >= count($array)) {
            // There is no variance with zero or one elements
            return 0;
        }

        $mean = array_mean($array);
        $sum  = array_reduce($array, function($carry, $value) use ($mean) {
            return $carry + (($value - $mean) ** 2);
        });

        return $sum / (count($array) - (int) $sample);
    }
}
