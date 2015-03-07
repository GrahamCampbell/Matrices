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
use GrahamCampbell\Matrices\Iterators\CollectionRowIterator;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the add collection operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class AddCollectionOperation implements CollectionOperationInterface
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
        $times = $collection->rows();
        $rows = [];

        for ($i = 0; $i < $times; ++$i) {
            $rows[] = static::generateRow($collection->row($i));
        }

        return new Matrix($rows);
    }

    protected static function generateRow(CollectionRowIterator $iterator)
    {
        $row = [];

        foreach ($iterator as $elements) {
            $row[] = array_sum($elements);
        }

        return $row;
    }
}
