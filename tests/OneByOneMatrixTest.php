<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices;

use GrahamCampbell\Matrices\Matrix;

/**
 * This is the 1x1 matrix test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class OneByOneMatrixTest extends AbstractMatrixTestCase
{
    protected function createMatrix()
    {
        return new Matrix([[7]]);
    }

    public function creationProvider()
    {
        return [
            [1, 1, 1, true],
        ];
    }

    public function rowProvider()
    {
        return [
            [0, [7]],
        ];
    }

    public function columnProvider()
    {
        return [
            [0, [7]],
        ];
    }
}
