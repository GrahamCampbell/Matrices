<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices\Iterators;

/**
 * This is the transposing elements iterator class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class TransposingElementsIterator extends AbstractCollectionIterator
{
    public function __construct($first, $second)
    {
        $this->iterators = [$first, $second];
    }
}
