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

use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\MatrixDeterminantOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix determinant operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixDeterminantOperatorTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[1, 3], [4, 5]], -7],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], 0],
            [[[1, 3, 1], [0, 4, 1], [2, -1, 0]], -1],
            [[[1, 2, 2, 1], [1, 2, 4, 2], [2, 7, 5, 2], [-1, 4, -6, 3]], -42],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindDeterminant($input, $result)
    {
        $det = MatrixDeterminantOperation::apply(new Matrix($input));

        $this->assertSame($result, $det);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices have a determinant.
     */
    public function testNotSquare()
    {
        MatrixDeterminantOperation::apply(new Matrix([[1, 2, 5, 6, 7]]));
    }
}
