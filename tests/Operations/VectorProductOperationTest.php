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
use GrahamCampbell\Matrices\Operations\VectorProductOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the vector product operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class VectorProductOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[[1], [0], [0]], [[0], [1], [0]]], [[0], [0], [1]]],
            [[[[1], [0], [0]], [[1], [0], [0]]], [[0], [0], [0]]],
            [[[[2], [4], [6]], [[8], [6], [4]]], [[-20], [40], [-20]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testVectorProduct($input, $result)
    {
        $matrices = [];

        foreach ($input as $matrix) {
            $matrices[] = new Matrix($matrix);
        }

        $vector = VectorProductOperation::apply(new Collection($matrices));

        $this->assertSame($result, $vector->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testInvalidDimensions()
    {
        $matrices = [new Matrix([[1, 2]]), new Matrix([[1], [2]])];

        VectorProductOperation::apply(new Collection($matrices));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage Only 1x3 matrices have a vector product.
     */
    public function testInvalidSize()
    {
        $matrices = [new Matrix([[1]]), new Matrix([[2]])];

        VectorProductOperation::apply(new Collection($matrices));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage The vector product requires exactly two matrices.
     */
    public function testInvalidNumber()
    {
        $matrices = [new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]]), new Matrix([[1], [2], [3]])];

        VectorProductOperation::apply(new Collection($matrices));
    }
}
