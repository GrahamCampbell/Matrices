<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices\Operations;

use GrahamCampbell\Matrices\Matrix;

/**
 * This is the intermediate matrix trait class.
 *
 * This trait is designed for internal use only.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
trait IntermediateMatrixTrait
{
    protected static function getIntermediateMatrix(Matrix $matrix)
    {
        $row = [];

        foreach ($matrix->row(0) as $index => $element) {
            $row[$index] = $element * MatrixMinorOperation::apply($matrix, ['row' => 0, 'column' => $index]);
        }

        return MatrixCofactorOperation::apply(new Matrix([$row]));
    }
}
