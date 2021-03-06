<?php

declare(strict_types=1);

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices\Operations;

use GrahamCampbell\Matrices\Exceptions\InvalidOptionsException;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the multiply matrix by scalar operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class MultiplyMatrixByScalarOperation implements MatrixOperationInterface
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
            throw new InvalidOptionsException('A scalar to multiply by is required.');
        }

        $scalar = $options['scalar'];
        $elements = [];

        foreach ($matrix as $row => $iterator) {
            foreach ($iterator as $column => $element) {
                $elements[$row][$column] = $element * $scalar;
            }
        }

        return new Matrix($elements);
    }
}
