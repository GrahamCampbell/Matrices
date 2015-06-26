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
use GrahamCampbell\Matrices\Exceptions\InvalidCollectionException;
use GrahamCampbell\Matrices\Matrix;

/**
 * This is the vector product operation class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class VectorProductOperation implements CollectionOperationInterface
{
    use MatrixThingyTrait;

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
        if ($collection->rows() !== 3 || $collection->columns() !== 1) {
            throw new InvalidCollectionException('Only 1x3 matrices have a vector product.');
        }

        if (count($collection) !== 2) {
            throw new InvalidCollectionException('The vector product requires exactly two matrices.');
        }

        return static::getMatrixThingy(static::generateMatrix($collection));
    }

    protected static function generateMatrix(Collection $collection)
    {
        $elements = [[1, 1, 1], [], []];

        foreach ($collection->column(0) as $index => $values) {
            $elements[1][$index] = $values[0];
            $elements[2][$index] = $values[1];
        }

        return new Matrix($elements);
    }
}
