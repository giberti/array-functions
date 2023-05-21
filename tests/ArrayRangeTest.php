<?php

class ArrayRangeTest extends \PHPUnit\Framework\TestCase
{

    public function provideRangeData()
    {
        return [
            [[1, 2, 3], 2],
            [[10, 20, 30], 20],
            [[-1, 0, 1], 2],
            [[3.21, 4.32, 5.43], 2.22],
        ];
    }

    /**
     * @dataProvider provideRangeData
     * @param $data
     * @param $expected
     */
    public function test_array_range($data, $expected)
    {
        $range = array_range($data);
        if (version_compare(\PHPUnit\Runner\Version::id(), '8.0.0', '>=')) {
             $this->assertEqualsWithDelta($expected, $range, 0.01);
        } else {
            $this->assertEquals($expected, $range, '', 0.01);
        }
    }

}