<?php

class ArrayMeanTest extends \PHPUnit\Framework\TestCase
{

    public function getDataSets()
    {
        return [
            'fibonacci'  => [[1, 1, 2, 3, 5, 8, 13, 21, 34, 55], 14.3],
            'pentagonal' => [[1, 5, 12, 22, 35, 51, 70, 92, 117, 145], 55],
            'floats'     => [[1.23, 2.34, 3.45, 4.56, 5.67, 6.78, 7.89, 8.90], 5.1025],
            'null'       => [[null, null], 0],
            'string'     => [['hello','world'], 0],
            'boolean'    => [[true, false], 0.5],
        ];
    }

    /**
     * @dataProvider getDataSets();
     */
    public function test_calculates_correct_answer($data, $mean)
    {
        $this->assertEquals($mean, array_mean($data));
    }

    public function getBadData() {
        return [
            'int'    => [1],
            'null'   => [null],
            'string' => ['hello'],
            'float'  => [1.1],
            'bool'   => [false]
        ];
    }

    /**
     * @dataProvider getBadData();
     */
    public function test_errors_with_bad_data($data)
    {
        $this->expectException(TypeError::class);
        array_mean($data);
    }

    public function test_empty_array()
    {
        $this->expectException(Exception::class);
        array_mean([]);
    }
}