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
use GrahamCampbell\Matrices\Exceptions\InvalidCollectionException;

/**
 * This is the scalar product operation class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ScalarProductOperation implements CollectionOperationInterface
{
    /**
     * Apply the operation to the given collection.
     *
     * @param \GrahamCampbell\Matrices\Collection $collection
     * @param array                               $options
     *
     * @return int|float
     */
    public static function apply(Collection $collection, array $options = [])
    {
        if ($collection->columns() !== 1) {
            throw new InvalidCollectionException('Only column matrices have a scalar product.');
        }

        if (count($collection) !== 2) {
            throw new InvalidCollectionException('The scalar product requires exactly two matrices.');
        }

        $product = 0;

        foreach ($collection->column(0) as $elements) {
            $product += array_product($elements);
        }

        return $product;
    }
}
