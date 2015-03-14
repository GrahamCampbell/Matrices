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
 * This is the transposing collection iterator class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class TransposingCollectionIterator extends AbstractCollectionIterator
{
    public function __construct(array $matrices)
    {
        $this->iterators = [
            new MatrixRowsIterator($matrices[0]->raw()),
            new MatrixColumnsIterator($matrices[1]->raw()),
        ];
    }

    public function current()
    {
        return new TransposingElementsIterator($this->iterators[0]->current(), $this->iterators[1]->current());
    }
}
