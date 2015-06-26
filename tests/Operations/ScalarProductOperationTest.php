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
use GrahamCampbell\Matrices\Operations\ScalarProductOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the scalar product operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ScalarProductOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[[1], [2]], [[3], [4]]], 11],
            [[[[1], [0], [0]], [[0], [1], [0]]], 0],
            [[[[1], [0], [0]], [[1], [0], [0]]], 1],
            [[[[2], [4], [6]], [[8], [6], [4]]], 64],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testScalarProduct($input, $result)
    {
        $matrices = [];

        foreach ($input as $matrix) {
            $matrices[] = new Matrix($matrix);
        }

        $scalar = ScalarProductOperation::apply(new Collection($matrices));

        $this->assertSame($result, $scalar);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testInvalidDimensions()
    {
        $matrices = [new Matrix([[1, 2]]), new Matrix([[1], [2]])];

        ScalarProductOperation::apply(new Collection($matrices));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage Only column matrices have a scalar product.
     */
    public function testInvalidSize()
    {
        $matrices = [new Matrix([[1, 2]]), new Matrix([[2, 5]])];

        ScalarProductOperation::apply(new Collection($matrices));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage The scalar product requires exactly two matrices.
     */
    public function testInvalidNumber()
    {
        $matrices = [new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]])];

        ScalarProductOperation::apply(new Collection($matrices));
    }
}
