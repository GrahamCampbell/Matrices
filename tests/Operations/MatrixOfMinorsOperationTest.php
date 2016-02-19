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
use GrahamCampbell\Matrices\Operations\MatrixOfMinorsOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix of minors operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixOfMinorsOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[42, 180], [100, 200]], [[200, 100], [180, 42]]],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [[-3, -6, -3], [-6, -12, -6], [-3, -6, -3]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindMatrixOfMinors($input, $result)
    {
        $matrix = MatrixOfMinorsOperation::apply(new Matrix($input));

        $this->assertSame($result, $matrix->raw());
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices with at least 4 elements have elements with minors.
     */
    public function testNotSquare()
    {
        MatrixOfMinorsOperation::apply(new Matrix([[1, 2, 5, 6, 7]]));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage Only square matrices with at least 4 elements have elements with minors.
     */
    public function testTooSmall()
    {
        MatrixOfMinorsOperation::apply(new Matrix([[1]]));
    }
}
