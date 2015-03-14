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
use GrahamCampbell\Matrices\Exceptions\InvalidMatrixException;
use GrahamCampbell\Matrices\Iterators\MatrixColumnIterator;
use GrahamCampbell\Matrices\Iterators\MatrixColumnsIterator;
use GrahamCampbell\Matrices\Iterators\MatrixRowIterator;
use GrahamCampbell\Matrices\Iterators\MatrixRowsIterator;

/**
 * This is the matrix class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Matrix implements Countable
{
    protected $elements;
    protected $rows;
    protected $columns;

    public function __construct(array $elements)
    {
        $this->elements = array_values($elements);

        $this->rows = count($this->elements);

        if ($this->rows < 1) {
            throw new InvalidMatrixException("The matrix must contain at least one row.");
        }

        $this->columns = count($this->elements[0]);

        if ($this->columns < 1) {
            throw new InvalidMatrixException("The matrix must contain at least one column.");
        }

        foreach ($this->elements as $row) {
            if (count($row) !== $this->columns) {
                throw new InvalidMatrixException("All rows must contain {$this->columns} columns.");
            }
        }
    }

    /**
     * Get the total number of elements.
     *
     * @return int
     */
    public function count()
    {
        return $this->rows * $this->columns;
    }

    /**
     * Get the number of rows.
     *
     * @return int
     */
    public function rows()
    {
        return $this->rows;
    }

    /**
     * Get the number of columns.
     *
     * @return int
     */
    public function columns()
    {
        return $this->columns;
    }

    /**
     * Are we a square matrix?
     *
     * @return bool
     */
    public function square()
    {
        return $this->rows === $this->columns;
    }

    public function raw()
    {
        return $this->elements;
    }

    public function row($index)
    {
        return new MatrixRowIterator($this->elements, $index);
    }

    public function column($index)
    {
        return new MatrixColumnIterator($this->elements, $index);
    }

    public function eachRow()
    {
        return new MatrixRowsIterator($this->elements);
    }

    public function eachColumn()
    {
        return new MatrixColumnsIterator($this->elements);
    }
}
