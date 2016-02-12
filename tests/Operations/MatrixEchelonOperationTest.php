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
use GrahamCampbell\Matrices\Operations\MatrixEchelonOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the matrix echelon operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixEchelonOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[1, 2], [3, 4]], [[1, -2], [-3, 4]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindEchelon($input, $result)
    {
        $echelon = MatrixEchelonOperation::apply(new Matrix($input));

        // var_dump($echelon->raw());

        // $this->assertSame($result, $echelon->raw());
    }
}
