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

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the sum collection operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class SumCollectionOperation implements CollectionOperationInterface
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
        $elements = [];

        foreach ($collection as $row => $iterator) {
            foreach ($iterator as $column => $values) {
                $elements[$row][$column] = array_sum($values);
            }
        }

        return new Matrix($elements);
    }
}
