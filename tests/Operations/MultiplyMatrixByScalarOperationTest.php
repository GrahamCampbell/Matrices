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

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\MultiplyMatrixByScalarOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the multiply matrix by a scalar operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MultiplyMatrixByScalarOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[2]], 1, [[2]]],
            [[[1, 2], [3, 4]], 2, [[2, 4], [6, 8]]],
            [[[5.5], [4]], -3, [[-16.5], [-12]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMutliplyByScalar($input, $scalar, $result)
    {
        $matrix = MultiplyMatrixByScalarOperation::apply(new Matrix($input), compact('scalar'));

        $this->assertSame($result, $matrix->raw());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage A scalar to multiply by is required.
     */
    public function testNoScalarProvided()
    {
        MultiplyMatrixByScalarOperation::apply(new Matrix([[1, 2], [3, 4]]));
    }
}
