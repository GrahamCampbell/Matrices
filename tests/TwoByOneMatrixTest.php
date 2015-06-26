<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices;

use GrahamCampbell\Matrices\Matrix;

/**
 * This is the 2x1 matrix test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class TwoByOneMatrixTest extends AbstractMatrixTestCase
{
    protected function createMatrix()
    {
        return new Matrix([[1, 2]]);
    }

    public function creationProvider()
    {
        return [
            [2, 1, 2, false],
        ];
    }

    public function rowProvider()
    {
        return [
            [0, [1, 2]],
        ];
    }

    public function columnProvider()
    {
        return [
            [0, [1]],
            [1, [2]],
        ];
    }
}
