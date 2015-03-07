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
 * This is the abstract collection iterator class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
abstract class AbstractCollectionIterator extends AbstractIterator
{
    protected $iterators = [];

    public function current()
    {
        $current = [];

        foreach ($this->iterators as $iterator) {
            $current[] = $iterator->current();
        }

        return $current;
    }

    public function next()
    {
        parent::next();

        foreach ($this->iterators as $iterator) {
            $iterator->next();
        }
    }

    public function rewind()
    {
        parent::rewind();

        foreach ($this->iterators as $iterator) {
            $iterator->rewind();
        }
    }

    public function valid()
    {
        return $this->iterators[0]->valid();
    }
}
