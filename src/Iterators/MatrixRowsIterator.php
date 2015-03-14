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
 * This is the matrix rows iterator class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MatrixRowsIterator extends AbstractIterator
{
    protected $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function current()
    {
        return new MatrixRowIterator($this->elements, $this->pos);
    }

    public function valid()
    {
        return isset($this->elements[$this->pos]);
    }
}
