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

use GrahamCampbell\Matrices\Exceptions\InvalidMatrixException;
use GrahamCampbell\Matrices\Exceptions\InvalidOptionsException;
use GrahamCampbell\Matrices\Iterators\MatrixRowIterator;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the matrix minor operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class MatrixMinorOperation implements MatrixOperationInterface
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
        $size = $matrix->rows();

        if (!$matrix->square() || $size < 2) {
            throw new InvalidMatrixException('Only square matrices with at least 4 elements have elements with minors.');
        }

        if (!isset($options['row']) || !isset($options['column'])) {
            throw new InvalidOptionsException('The position of the element in the matrix is required.');
        }

        if ($options['row'] >= $size || $options['row'] < 0 || $options['column'] >= $size || $options['column'] < 0) {
            throw new InvalidOptionsException('The position of the element in the matrix must exist in the matrix.');
        }

        return MatrixDeterminantOperation::apply(static::generateMatrix($matrix, $options['row'], $options['column']));
    }

    protected static function generateMatrix(Matrix $matrix, $row, $column)
    {
        $rows = [];

        foreach ($matrix as $index => $iterator) {
            if ($index === $row) {
                continue;
            }

            $rows[] = static::generateRow($iterator, $column);
        }

        return new Matrix($rows);
    }

    protected static function generateRow(MatrixRowIterator $iterator, $column)
    {
        $row = [];

        foreach ($iterator as $index => $element) {
            if ($index === $column) {
                continue;
            }

            $row[] = $element;
        }

        return $row;
    }
}
