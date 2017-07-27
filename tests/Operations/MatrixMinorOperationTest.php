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

use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\MatrixMinorOperation;
use PHPUnit\Framework\TestCase;

/**
 * This is the matrix minor operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixMinorOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[1, 3], [4, 5]], [0, 0], 5],
            [[[1, 3], [4, 5]], [0, 1], 4],
            [[[1, 3], [4, 5]], [1, 0], 3],
            [[[1, 3], [4, 5]], [1, 1], 1],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [1, 1], -12],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [0, 2], -3],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindMinor($input, $pos, $result)
    {
        $minor = MatrixMinorOperation::apply(new Matrix($input), ['row' => $pos[0], 'column' => $pos[1]]);

        $this->assertSame($result, $minor);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices with at least 4 elements have elements with minors.
     */
    public function testNotSquare()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2, 5, 6, 7]]), ['row' => 0, 'column' => 0]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices with at least 4 elements have elements with minors.
     */
    public function testTooSmall()
    {
        MatrixMinorOperation::apply(new Matrix([[1]]), ['row' => 0, 'column' => 0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix is required.
     */
    public function testNoRowProvided()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['column' => 1]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix is required.
     */
    public function testNoColumnProvided()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['row' => 1]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix must exist in the matrix.
     */
    public function testRowOutsideBounds()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['row' => 6, 'column' => 0]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix must exist in the matrix.
     */
    public function testRowNegative()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['row' => -1, 'column' => 1]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix must exist in the matrix.
     */
    public function testColumnOutsideBounds()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['row' => 0, 'column' => 2]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The position of the element in the matrix must exist in the matrix.
     */
    public function testColumnNegative()
    {
        MatrixMinorOperation::apply(new Matrix([[1, 2], [3, 4]]), ['row' => 1, 'column' => -5]);
    }
}
