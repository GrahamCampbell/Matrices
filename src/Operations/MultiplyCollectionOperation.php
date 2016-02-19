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

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Exceptions\InvalidCollectionException;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the multiply collection operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class MultiplyCollectionOperation implements CollectionOperationInterface
{
    /**
     * Apply the operation to the given matrix collection.
     *
     * @param \GrahamCampbell\Matrices\Collection $collection
     * @param array                               $options
     *
     * @return \GrahamCampbell\Matrices\Matrix
     */
    public static function apply(Collection $collection, array $options = [])
    {
        if (count($collection) !== 2) {
            throw new InvalidCollectionException('The matrix product requires exactly two matrices.');
        }

        $matrices = $collection->matrices();

        if ($matrices[0]->columns() !== $matrices[1]->rows()) {
            throw new InvalidCollectionException('The dimentions of the two matrices are not suitable.');
        }

        $first = $matrices[0]->rows();
        $second = $matrices[1]->columns();
        $common = $matrices[0]->columns();

        $elements = [];

        for ($i = 0; $i < $first; ++$i) {
            for ($j = 0; $j < $second; ++$j) {
                $elements[$i][$j] = 0;
                for ($k = 0; $k < $common; ++$k) {
                    $elements[$i][$j] += $matrices[0]->element($i, $k) * $matrices[1]->element($k, $j);
                }
            }
        }

        return new Matrix($elements);
    }
}
