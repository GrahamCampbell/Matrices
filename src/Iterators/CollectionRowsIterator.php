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
 * This is the collection rows iterator class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CollectionRowsIterator extends AbstractIterator
{
    protected $matrices;
    protected $raw;

    public function __construct(array $matrices)
    {
        $this->matrices = $matrices;
        $this->raw = $matrices[0]->raw();
    }

    public function current()
    {
        return new CollectionRowIterator($this->matrices, $this->pos);
    }

    public function valid()
    {
        return isset($this->raw[$this->pos]);
    }
}
