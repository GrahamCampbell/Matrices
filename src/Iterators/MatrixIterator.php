<?php

declare(strict_types=1);

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
 * This is the matrix iterator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class MatrixIterator extends AbstractIterator
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
