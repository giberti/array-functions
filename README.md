# Array Functions

Provides additional array functionality to augment the built in `array_*` functions for use in common calculations.

#### string array_fingerprint($array)

Creates a fingerprint for the array, useful for caching values.
```php
$values = [1,2,2,3];
$fingerprint = array_fingerprint($values);
echo $fingerprint; // f591c5a8a39f752a2040e2364e775aec
```

#### float array_mean($array)

Finds the mean (average) value of the elements in an array of numeric values.
```php
$values = [1,2,2,3];
$mean = array_mean($values);
echo $mean; // 2
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
