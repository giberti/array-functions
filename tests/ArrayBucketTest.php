<?php

class ArrayBucketTest extends \PHPUnit\Framework\TestCase {

    public function provideTestBuckets() {
        return [
            [[1], 1, [1]],
            [[1,2], 1, [2]],
            [[1,1,1], 1, [3]],
            [[1,2,2,3,3,3], 3, [1, 2, 3]],
            [[1,2,3,4,5,6,7,8,9,10], 4, [2,3,3,2]],
            [[0,50,100], 3, [1, 1 ,1]],
            [[1,2,3,4,5,6,7,8,9,10,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1], 6, [16,2,2,2,2,1]],
        ];
    }

    /**
     * @dataProvider provideTestBuckets
     * @param $array
     * @param $buckets
     * @param $expected
     */
    public function test_array_bucket($array, $buckets, $expected) {
        $result = array_bucket($array);
        $this->assertEquals($buckets, count($result), 'Unexpected number of buckets');
        $this->assertEquals($expected, array_values($result), 'Unexpected counts per bucket');
    }

}