<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices\Operations;

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\SumCollectionOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the sum collection operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SumCollectionOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[[7.1]], [[4.2]]], [[11.3]]],
            [[[[0]], [[2]], [[4]], [[-9]]], [[-3]]],
            [[[[2, 6.1], [7, 9.6]], [[4.1, 1], [-6, 0]]], [[6.1, 7.1], [1, 9.6]]],
            [[[[1, 2], [3, 4], [5, 6], [7, 8]], [[8, 7], [6, 5], [4, 3], [2, 1]]], [[9, 9], [9, 9], [9, 9], [9, 9]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testSumCollection($input, $result)
    {
        $matrices = [];

        foreach ($input as $matrix) {
            $matrices[] = new Matrix($matrix);
        }

        $matrix = SumCollectionOperation::apply(new Collection($matrices));

        $this->assertSame($result, $matrix->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testInvalidDimensions()
    {
        $matrices = [new Matrix([[1, 2]]), new Matrix([[1], [2]])];

        SumCollectionOperation::apply(new Collection($matrices));
    }
}
