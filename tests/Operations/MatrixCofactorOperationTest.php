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
use GrahamCampbell\Matrices\Operations\MatrixCofactorOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix cofactor operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixCofactorOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[1]], [[1]]],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [[1, -2, 3], [-4, 5, -6], [7, -8, 9]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindCofactor($input, $result)
    {
        $cofactor = MatrixCofactorOperation::apply(new Matrix($input));

        $this->assertSame($result, $cofactor->raw());
    }
}
