<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices;

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the collection test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CollectionTest extends TestCase
{
    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage A collection must be made from 2 or more matrices.
     */
    public function testZeroMatricesFail()
    {
        new Collection([]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage A collection must be made from 2 or more matrices.
     */
    public function testOneMatrixFails()
    {
        new Collection([new Matrix([[1, 2], [3, 4]])]);
    }

    public function testCollectionCount()
    {
        $collection = new Collection([new Matrix([[1, 2]]), new Matrix([[3, 4]])]);

        $this->assertCount(2, $collection);
        $this->assertSame(1, $collection->rows());
        $this->assertSame(2, $collection->columns());
    }

    public function testSameDimensions()
    {
        $collection = new Collection([new Matrix([[1, 2]]), new Matrix([[3, 4]]), new Matrix([[5, 6]])]);

        $this->assertTrue($collection->sameDimensions());
    }

    public function testNotSameDimensions()
    {
        $collection = new Collection([new Matrix([[1, 2], [3, 4]]), new Matrix([[5]])]);

        $this->assertFalse($collection->sameDimensions());
    }

    public function testRowsIterator()
    {
        $collection = new Collection([new Matrix([[1, 2], [3, 4]]), new Matrix([[5, 6], [7, 8]])]);

        $this->assertTrue($collection->sameDimensions());

        $result = [];

        foreach ($collection->eachRow() as $row => $iterator) {
            foreach ($iterator as $column => $values) {
                $result[$row][$column] = $values;
            }
        }

        $this->assertSame([[[1, 5], [2, 6]], [[3, 7], [4, 8]]], $result);
    }

    public function testColumnsIterator()
    {
        $collection = new Collection([new Matrix([[1, 2], [3, 4]]), new Matrix([[5, 6], [7, 8]])]);

        $this->assertTrue($collection->sameDimensions());

        $result = [];

        foreach ($collection->eachColumn() as $row => $iterator) {
            foreach ($iterator as $column => $values) {
                $result[$row][$column] = $values;
            }
        }

        $this->assertSame([[[1, 5], [3, 7]], [[2, 6], [4, 8]]], $result);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testRowsIteratorFail()
    {
        $collection = new Collection([new Matrix([[1], [2]]), new Matrix([[3, 4]])]);

        $this->assertFalse($collection->sameDimensions());

        foreach ($collection->eachRow() as $iterator) {
            // we shouldn't get here
        }
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testColumnsIteratorFail()
    {
        $collection = new Collection([new Matrix([[1], [2]]), new Matrix([[3, 4]])]);

        $this->assertFalse($collection->sameDimensions());

        foreach ($collection->eachColumn() as $iterator) {
            // we shouldn't get here
        }
    }

    public function testRows()
    {
        $collection = new Collection([new Matrix([[1, 2], [3, 4]]), new Matrix([[5, 6], [7, 8]])]);

        $this->assertTrue($collection->sameDimensions());

        $result = [];

        foreach ($collection->row(0) as $column => $values) {
            $result[$column] = $values;
        }

        $this->assertSame([[1, 5], [2, 6]], $result);

        $result = [];

        foreach ($collection->row(1) as $column => $values) {
            $result[$column] = $values;
        }

        $this->assertSame([[3, 7], [4, 8]], $result);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testRowsFail()
    {
        $collection = new Collection([new Matrix([[1], [2]]), new Matrix([[3, 4]])]);

        $this->assertFalse($collection->sameDimensions());

        foreach ($collection->row(0) as $iterator) {
            // we shouldn't get here
        }
    }

    public function testColumns()
    {
        $collection = new Collection([new Matrix([[1, 2], [3, 4]]), new Matrix([[5, 6], [7, 8]])]);

        $this->assertTrue($collection->sameDimensions());

        $result = [];

        foreach ($collection->column(0) as $column => $values) {
            $result[$column] = $values;
        }

        $this->assertSame([[1, 5], [3, 7]], $result);

        $result = [];

        foreach ($collection->column(1) as $column => $values) {
            $result[$column] = $values;
        }

        $this->assertSame([[2, 6], [4, 8]], $result);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidCollectionException
     * @expectedExceptionMessage All matrices in the collection must have the same dimensions.
     */
    public function testColumnsFail()
    {
        $collection = new Collection([new Matrix([[1], [2]]), new Matrix([[3, 4]])]);

        $this->assertFalse($collection->sameDimensions());

        foreach ($collection->column(0) as $iterator) {
            // we shouldn't get here
        }
    }
}
