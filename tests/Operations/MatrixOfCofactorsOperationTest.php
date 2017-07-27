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
use GrahamCampbell\Matrices\Operations\MatrixOfCofactorsOperation;
use PHPUnit\Framework\TestCase;

/**
 * This is the matrix of cofactors operation test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixOfCofactorsOperationTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [[[42, 180], [100, 200]], [[200, -100], [-180, 42]]],
            [[[1, 2, 3], [4, 5, 6], [7, 8, 9]], [[-3, 6, -3], [6, -12, 6], [-3, 6, -3]]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFindMatrixOfCofactors($input, $result)
    {
        $cofactor = MatrixOfCofactorsOperation::apply(new Matrix($input));

        $this->assertSame($result, $cofactor->raw());
    }
}
