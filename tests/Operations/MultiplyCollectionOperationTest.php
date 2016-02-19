<?php

declare(strict_types=1);

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
use GrahamCampbell\Matrices\Operations\MultiplyCollectionOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the sum collection operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MultiplyCollectionOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[[1]], [[2]]], [[2]]],
            [[[[1, 2], [3, 4]], [[5, 6], [7, 8]]], [[19, 22], [43, 50]]],
            [[[[5, 6], [7, 8]], [[1, 2], [3, 4]]], [[23, 34], [31, 46]]],
            [[[[1], [2], [3]], [[4, 5, 6]]], [[4, 5, 6], [8, 10, 12], [12, 15, 18]]],
            [[[[4, 5, 6]], [[1], [2], [3]]], [[32]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMultiplyCollection($input, $result)
    {
        $matrices = [];

        foreach ($input as $matrix) {
            $matrices[] = new Matrix($matrix);
        }

        $matrix = MultiplyCollectionOperation::apply(new Collection($matrices));

        $this->assertSame($result, $matrix->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage The dimentions of the two matrices are not suitable.
     */
    public function testInvalidDimensions()
    {
        $matrices = [new Matrix([[1, 2]]), new Matrix([[1], [2], [3]])];

        MultiplyCollectionOperation::apply(new Collection($matrices));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage The matrix product requires exactly two matrices.
     */
    public function testInvalidNumber()
    {
        $matrices = [new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]])];

        MultiplyCollectionOperation::apply(new Collection($matrices));
    }
}
