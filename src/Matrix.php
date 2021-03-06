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

namespace GrahamCampbell\Matrices;

use Countable;
use GrahamCampbell\Matrices\Exceptions\InvalidElementException;
use GrahamCampbell\Matrices\Exceptions\InvalidMatrixException;
use GrahamCampbell\Matrices\Iterators\MatrixColumnIterator;
use GrahamCampbell\Matrices\Iterators\MatrixIterator;
use GrahamCampbell\Matrices\Iterators\MatrixRowIterator;
use IteratorAggregate;

/**
 * This is the matrix class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
final class Matrix implements Countable, IteratorAggregate
{
    protected $elements;
    protected $rows;
    protected $columns;

    public function __construct(array $elements)
    {
        $this->elements = array_values($elements);

        $this->rows = count($this->elements);

        if ($this->rows < 1) {
            throw new InvalidMatrixException('The matrix must contain at least one row.');
        }

        $this->columns = count($this->elements[0]);

        if ($this->columns < 1) {
            throw new InvalidMatrixException('The matrix must contain at least one column.');
        }

        foreach ($this->elements as $row) {
            if (count($row) !== $this->columns) {
                throw new InvalidMatrixException("All rows must contain {$this->columns} columns.");
            }
        }
    }

    /**
     * Get an individual element from the matrix.
     *
     * @return int|float
     */
    public function element($i, $j)
    {
        if (!isset($this->elements[$i][$j])) {
            throw new InvalidElementException('The given element does not exist in the matrix.');
        }

        return $this->elements[$i][$j];
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

    public function getIterator()
    {
        return new MatrixIterator($this->elements);
    }
}
