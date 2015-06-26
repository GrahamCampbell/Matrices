<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices\Iterators;

/**
 * This is the collection row iterator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CollectionRowIterator extends AbstractCollectionIterator
{
    public function __construct(array $matrices, $index)
    {
        foreach ($matrices as $matrix) {
            $this->iterators[] = $matrix->row($index);
        }
    }
}
