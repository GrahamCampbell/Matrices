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

use Iterator;

/**
 * This is the abstract iterator class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractIterator implements Iterator
{
    protected $pos = 0;

    public function key()
    {
        return $this->pos;
    }

    public function next()
    {
        ++$this->pos;
    }

    public function rewind()
    {
        $this->pos = 0;
    }
}
