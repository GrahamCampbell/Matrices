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
 * This is the 1x2 matrix test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class OneByTwoMatrixTest extends AbstractMatrixTestCase
{
    protected function createMatrix()
    {
        return new Matrix([[42], [50]]);
    }

    public function creationProvider()
    {
        return [
            [2, 2, 1, false],
        ];
    }

    public function rowProvider()
    {
        return [
            [0, [42]],
            [1, [50]],
        ];
    }

    public function columnProvider()
    {
        return [
            [0, [42, 50]],
        ];
    }
}
