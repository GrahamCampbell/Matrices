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
 * This is the matrix adjoint operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixAdjointOperation implements MatrixOperationInterface
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
            throw new InvalidMatrixException('Only square matrices have an adjoint.');
        }

        switch ($matrix->rows()) {
            case 1:
                return $matrix;
            case 2:
                return static::adjointTwoByTwo($matrix);
            default:
                return static::adjointLarge($matrix);
        }
    }

    protected static function adjointTwoByTwo(Matrix $matrix)
    {
        $raw = $matrix->raw();

        return new Matrix([[$raw[1][1], - $raw[1][0]], [- $raw[0][1], $raw[0][0]]]);
    }

    protected static function adjointLarge(Matrix $matrix)
    {
        $minors = MatrixOfMinorsOperation::apply($matrix);

        return MatrixTransposeOperation::apply(MatrixCofactorOperation::apply($minors));
    }
}
