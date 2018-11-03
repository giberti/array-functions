# Array Functions

Provides additional array functionality, augmenting the built in `array_*` functions for use in common descriptive statistic calculations.

## Quality

[![Build Status](https://api.travis-ci.org/giberti/array-functions.svg?branch=master)](https://travis-ci.org/giberti/array-functions)

## Installing

This library requires PHP 7.1 or newer.

```
composer require giberti/array-functions
```

## Usage

#### string array_fingerprint($array)

Creates a fingerprint for the array, useful for caching values.
```php
$values = [1,2,2,3];
$fingerprint = array_fingerprint($values);
echo $fingerprint; // f591c5a8a39f752a2040e2364e775aec
```

#### float[] array_bucket($array, [$buckets = null])
Groups array values into buckets suitable for source data for a histogram. Takes an optional parameter to force the number of buckets the content should be distributed into.
```php
$values = [1,2,2,3,3,3];
$buckets = array_bucket($values);
print_r($buckets);
// Array (
//           [[0.5,1.5)] => 1
//           [[1.5,2.5)] => 2
//           [[2.5,3.5]] => 3
//       )
```


#### float array_mean($array)

Finds the mean (average) value of the elements in an array of numeric values.
```php
$values = [1,2,2,3];
$mean = array_mean($values);
echo $mean; // 2
```

#### float array_range($array)

Finds the difference between the minimum value and the maximum value in the array.
```php
$values = [1,2,3];
$difference = array_range($values);
echo $difference; // 2
```

#### float array_variance($array [, $sample = true])

Finds the variance for a given array. Works with populations as well as samples.

```php
$values = [1,2,2,3];
$variance = array_variance($values);
echo $variance; // 0.66666666666667

$standardDeviation = sqrt($variance);
echo $standardDeviation; // 0.81649658092773
```
