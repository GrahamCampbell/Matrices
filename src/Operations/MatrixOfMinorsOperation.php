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
 * This is the matrix of minors operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixOfMinorsOperation implements MatrixOperationInterface
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
        $elements = [];

        foreach ($matrix as $row => $iterator) {
            foreach ($iterator as $column => $element) {
                $elements[$row][$column] = MatrixMinorOperation::apply($matrix, ['row' => $row, 'column' => $column]);
            }
        }

        return new Matrix($elements);
    }
}
