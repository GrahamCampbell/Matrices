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

use Countable;
use GrahamCampbell\Matrices\Exceptions\InvalidCollectionException;
use GrahamCampbell\Matrices\Iterators\CollectionColumnIterator;
use GrahamCampbell\Matrices\Iterators\CollectionColumnsIterator;
use GrahamCampbell\Matrices\Iterators\CollectionRowIterator;
use GrahamCampbell\Matrices\Iterators\CollectionRowsIterator;
use GrahamCampbell\Matrices\Iterators\TransposingCollectionIterator;

/**
 * This is the matrix collection class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Collection implements Countable
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

    protected function guardDimensions()
    {
        if (!$this->sameDimensions()) {
            throw new InvalidCollectionException('All matrices in the collection must have the same dimensions.');
        }
    }

    public function rows()
    {
        $this->guardDimensions();

        return $this->matrices[0]->rows();
    }

    public function columns()
    {
        $this->guardDimensions();

        return $this->matrices[0]->columns();
    }

    public function row($index)
    {
        $this->guardDimensions();

        return new CollectionRowIterator($this->matrices, $index);
    }

    public function column($index)
    {
        $this->guardDimensions();

        return new CollectionColumnIterator($this->matrices, $index);
    }

    public function eachRow()
    {
        $this->guardDimensions();

        return new CollectionRowsIterator($this->matrices);
    }

    public function eachColumn()
    {
        $this->guardDimensions();

        return new CollectionColumnsIterator($this->matrices);
    }

    public function transposingEach()
    {
        if ($this->count() !== 2) {
            throw new InvalidCollectionException('The collection must contain exactly 2 matrices.');
        }

        if ($this->matrices[0]->columns() !== $this->matrices[1]->rows()) {
            throw new InvalidCollectionException('The number of columns in the first matrix must match the number of rows in the second.');
        }

        return new TransposingCollectionIterator($this->matrices);
    }
}
