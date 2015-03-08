<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices\Operations;

use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\MatrixInverseOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix inverse operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixInverseOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[42]], [[1 / 42]]],
            [[[1, 2], [3, 4]], [[-2.0, 1.5], [1.0, -0.5]]],
            [[[1, 3, 1], [0, 4, 1], [2, -1, 0]], [[-1, 1, 1], [-2, 2, 1], [8, -7, -4]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindInverse($input, $result)
    {
        $inverse = MatrixInverseOperation::apply(new Matrix($input));

        $this->assertSame($result, $inverse->raw());
    }

    public function testFindInverseOfLargeIdentity()
    {
        $matrix = new Matrix([[1, 0, 0, 0, 0], [0, 1, 0, 0, 0], [0, 0, 1, 0, 0], [0, 0, 0, 1, 0], [0, 0, 0, 0, 1]]);

        $inverse = MatrixInverseOperation::apply($matrix);

        $this->assertSame($matrix->raw(), $inverse->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices have an inverse.
     */
    public function testNotSquare()
    {
        MatrixInverseOperation::apply(new Matrix([[1, 2, 5, 6, 7]]));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only non-singular matrices have an inverse.
     */
    public function testSingular()
    {
        MatrixInverseOperation::apply(new Matrix([[1, 2, 3], [4, 5, 6], [7, 8, 9]]));
    }
}
