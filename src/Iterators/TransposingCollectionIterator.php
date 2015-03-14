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
            new MatrixRowsIterator($this->matrices[0]),
            new MatrixColumnsIterator($this->matrices[1]),
        ];
    }
}
