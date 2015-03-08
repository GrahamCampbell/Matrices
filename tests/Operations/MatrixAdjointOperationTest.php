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
use GrahamCampbell\Matrices\Operations\MatrixAdjointOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix adjoint operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixAdjointOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[42]], [[42]]],
            [[[1, 2], [3, 4]], [[4, -2], [-3, 1]]],
            [[[1, 3, 1], [0, 4, 1], [2, -1, 0]], [[1, -1, -1], [2, -2, -1], [-8, 7, 4]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindAdjoint($input, $result)
    {
        $adjoint = MatrixAdjointOperation::apply(new Matrix($input));

        $this->assertSame($result, $adjoint->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices have an adjoint.
     */
    public function testNotSquare()
    {
        MatrixAdjointOperation::apply(new Matrix([[1, 2, 5, 6, 7]]));
    }
}
