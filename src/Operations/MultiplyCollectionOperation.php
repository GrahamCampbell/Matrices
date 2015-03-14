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

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the multiply collection operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MultiplyCollectionOperation implements CollectionOperationInterface
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

        foreach ($collection->transposingEach() as $column => $iterator) {
            foreach ($iterator as $row => $values) {
                $elements[$row][$column] = $values;
            }
        }

        return $elements;
    }
}
