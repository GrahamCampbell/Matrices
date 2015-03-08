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
 * This is the matrix inverse operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixInverseOperation implements MatrixOperationInterface
{
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
            throw new InvalidMatrixException('Only square matrices have an inverse.');
        }

        if ($matrix->rows() === 1) {
            return new Matrix([[1 / $matrix->raw()[0][0]]]);
        }

        return static::inverseLarge($matrix);
    }

    protected static function inverseLarge(Matrix $matrix)
    {
        $det = MatrixDeterminantOperation::apply($matrix);

        // deal with floats that are nearly 0.0
        if (round((float) $det, 8) === 0.0) {
            throw new InvalidMatrixException('Only non-singular matrices have an inverse.');
        }

        $adjoint = MatrixAdjointOperation::apply($matrix);

        return MultiplyMatrixByScalarOperation::apply($adjoint, ['scalar' => 1 / $det]);
    }
}
