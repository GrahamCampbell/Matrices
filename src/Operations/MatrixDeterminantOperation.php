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

use GrahamCampbell\Matrices\Exceptions\InvalidMatrixException;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the matrix determinant operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixDeterminantOperation implements MatrixOperationInterface
{
    use IntermediateMatrixTrait;

    /**
     * Apply the operation to the given matrix.
     *
     * @param \GrahamCampbell\Matrices\Matrix $matrix
     * @param array                           $options
     *
     * @return int|float
     */
    public static function apply(Matrix $matrix, array $options = [])
    {
        if (!$matrix->square()) {
            throw new InvalidMatrixException('Only square matrices have a determinant.');
        }

        if ($matrix->rows() === 1) {
            return $matrix->raw()[0][0];
        }

        return static::detLarge($matrix);
    }

    protected static function detLarge(Matrix $matrix)
    {
        $det = 0;

        foreach (static::getIntermediateMatrix($matrix)->row(0) as $element) {
            $det += $element;
        }

        return $det;
    }
}
