<?php

class ArrayVarianceTest extends \PHPUnit\Framework\TestCase
{

    public function getDataSets()
    {
        return [
            'fibonacci'  => [[1, 1, 2, 3, 5, 8, 13, 21, 34, 55], 316.67778],
            'pentagonal' => [[1, 5, 12, 22, 35, 51, 70, 92, 117, 145], 2478.66667],
            'floats'     => [[1.23, 2.34, 3.45, 4.56, 5.67, 6.78, 7.89, 8.90], 7.28285],
            'null'       => [[null, null], 0],
            'boolean'    => [[true, false], 0.5],
        ];
    }

    /**
     * @dataProvider getDataSets
     */
    public function test_calculates_correct_answer($data, $expected)
    {
        $this->assertEquals($expected, round(array_variance($data), 5));
    }

}