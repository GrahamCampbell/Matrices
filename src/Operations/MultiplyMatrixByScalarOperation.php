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

use GrahamCampbell\Matrices\Iterators\MatrixRowIterator;
use GrahamCampbell\Matrices\Matrix;
use InvalidArgumentException;

/**
 * This is the multiply matrix by scalar operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MultiplyMatrixByScalarOperation implements MatrixOperationInterface
{
    /**
     * Apply the operation to the given matrix.
     *
     * @param \GrahamCampbell\Matrices\Matrix $matrix
     * @param array                           $options
     *
     * @return \GrahamCampbell\Matrices\Matrix
     */
    public static function apply(Matrix $matrix, array $options = [])
    {
        if (!isset($options['scalar'])) {
            throw new InvalidArgumentException('A scalar to multiply by is required.');
        }

        $scalar = $options['scalar'];
        $rows = [];

        foreach ($matrix as $iterator) {
            $rows[] = static::generateRow($iterator, $scalar);
        }

        return new Matrix($rows);
    }

    protected static function generateRow(MatrixRowIterator $iterator, $scalar)
    {
        $row = [];

        foreach ($iterator as $element) {
            $row[] = $element * $scalar;
        }

        return $row;
    }
}
