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
use GrahamCampbell\Matrices\Operations\MatrixTransposeOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix transpose operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixTransposeOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[1]], [[1]]],
            [[[42, 180]], [[42], [180]]],
            [[[5, 10], [2, 4]], [[5, 2], [10, 4]]],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [[1, 4, 7], [2, 5, 8], [3, 6, 9]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindTranspose($input, $result)
    {
        $transpose = MatrixTransposeOperation::apply(new Matrix($input));

        $this->assertSame($result, $transpose->raw());
    }
}
