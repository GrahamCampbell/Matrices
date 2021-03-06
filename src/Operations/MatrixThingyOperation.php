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

use GrahamCampbell\Matrices\Matrix;

/**
 * This is the matrix thingy operation class.
 *
 * @internal
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class MatrixThingyOperation implements MatrixOperationInterface
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

        foreach ($matrix->row(0) as $index => $element) {
            if (round((float) $element, 8) === 0.0) {
                $elements[$index][] = 0;
            } else {
                $elements[$index][] = $element * MatrixMinorOperation::apply($matrix, ['row' => 0, 'column' => $index]) * pow(-1, $index);
            }
        }

        return new Matrix($elements);
    }
}
