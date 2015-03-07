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

/**
 * This is the collection operation interface.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
interface CollectionOperationInterface
{
    /**
     * Apply the operation to the given matrix collection.
     *
     * @param \GrahamCampbell\Matrices\Collection $collection
     * @param array                               $options
     *
     * @return mixed
     */
    public static function apply(Collection $collection, array $options = []);
}
