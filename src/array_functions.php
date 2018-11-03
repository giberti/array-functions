<?php

if (!function_exists('array_bucket')) {
    /**
     * Counts the frequency of a value falling within a range
     *
     * @param $array
     * @param int $buckets
     *
     * @return array
     */
    function array_bucket($array, $buckets = null)
    {

        $min = min($array);
        $max = max($array);
        $range = ($max - $min);
        if (0 === $range) {
            // The entire data set is the same value
            return ["[{$max}]" => count($array)];
        }

        // Automatically calculate buckets if it's not provided.
        if (!$buckets) {
            $buckets = round(sqrt(count($array)), 0);
            if ($buckets <= 1) {
                // A single bucket would be used, shortcut the response
                return ["[{$min}-{$max}]" => count($array)];
            }
        }

        // Calculate the interval and boundaries for the data
        $interval = $range / $buckets;
        $start = $min - ($interval/2);
        $end = $start + $interval;
        $data = [];

        do {
            // Determine if this is the last range
            $last = $end > $max;
            $key = "[{$start},{$end})"; // exclusive of end value
            if ($last) {
                $key = "[{$start},{$end}]"; // inclusive of end value
            }

            // Count occurrences in the range
            $data[$key] = array_reduce($array, function($carry, $value) use ($start, $end, $last) {
                if ($value >= $start && $value < $end) {
                    $carry++;
                } elseif ($last && $value >= $start && $value <= $end) {
                    $carry++;
                }

                return $carry;
            });

            // Increment the window
            $start = $end;
            $end = $start + $interval;
        } while ($start <= $max);

        return $data;
    }
}

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

if (!function_exists('array_range')) {
    /**
     * Returns the difference between the minimum value and maximum value
     *
     * @param array $array
     *
     * @return float
     */
    function array_range(array $array)
    {
        return max($array) - min($array);
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
