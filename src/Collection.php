<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Matrices;

use ArrayIterator;
use Countable;
use GrahamCampbell\Matrices\Exceptions\InvalidCollectionException;
use GrahamCampbell\Matrices\Iterators\CollectionColumnIterator;
use GrahamCampbell\Matrices\Iterators\CollectionRowIterator;
use IteratorAggregate;

/**
 * This is the matrix collection class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Collection implements Countable, IteratorAggregate
{
    protected $matrices;
    protected $sameDimensions;

    public function __construct(array $matrices)
    {
        if (count($matrices) < 2) {
            throw new InvalidCollectionException('A collection must be made from 2 or more matrices.');
        }

        $this->matrices = $matrices;
    }

    /**
     * Get the total number of matrices.
     *
     * @return int
     */
    public function count()
    {
        return count($this->matrices);
    }

    /**
     * Are all the matrices in the collection of the same dimensions?
     *
     * @return bool
     */
    public function sameDimensions()
    {
        if ($this->sameDimensions !== null) {
            return $this->sameDimensions;
        }

        $rows = $this->matrices[0]->rows();
        $columns = $this->matrices[0]->columns();

        foreach ($this->matrices as $matrix) {
            if ($matrix->rows() !== $rows || $matrix->columns() !== $columns) {
                return $this->sameDimensions = false;
            }
        }

        return $this->sameDimensions = true;
    }

    public function rows()
    {
        if (!$this->sameDimensions()) {
            throw new InvalidCollectionException('All matrices in the collection must have the same dimensions.');
        }

        return $this->matrices[0]->rows();
    }

    public function columns()
    {
        if (!$this->sameDimensions()) {
            throw new InvalidCollectionException('All matrices in the collection must have the same dimensions.');
        }

        return $this->matrices[0]->columns();
    }

    public function row($index)
    {
        if (!$this->sameDimensions()) {
            throw new InvalidCollectionException('All matrices in the collection must have the same dimensions.');
        }

        return new CollectionRowIterator($this->matrices, $index);
    }

    public function column($index)
    {
        if (!$this->sameDimensions()) {
            throw new InvalidCollectionException('All matrices in the collection must have the same dimensions.');
        }

        return new CollectionColumnIterator($this->matrices, $index);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->matrices);
    }
}
