<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices\Operations;

use GrahamCampbell\Matrices\Matrix;

/**
 * This is the matrix thingy trait class.
 *
 * This trait is designed for internal use only.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
trait MatrixThingyTrait
{
    protected static function getMatrixThingy(Matrix $matrix)
    {
        $elements = [];

        foreach ($matrix->row(0) as $index => $element) {
            $elements[$index][] = $element * MatrixMinorOperation::apply($matrix, ['row' => 0, 'column' => $index]);
        }

        return MatrixCofactorOperation::apply(new Matrix($elements));
    }
}
