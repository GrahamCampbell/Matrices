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
 * This is the matrix column iterator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixColumnIterator extends AbstractIterator
{
    protected $elements;

    protected $index;

    public function __construct(array $elements, $index)
    {
        $this->elements = $elements;
        $this->index = $index;
    }

    public function current()
    {
        return $this->elements[$this->pos][$this->index];
    }

    public function valid()
    {
        return isset($this->elements[$this->pos]);
    }
}
