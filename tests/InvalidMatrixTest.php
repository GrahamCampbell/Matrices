<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices;

use GrahamCampbell\Matrices\Matrix;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the invalid matrix test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class InvalidMatrixTest extends TestCase
{
    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage All rows must contain 2 columns.
     */
    public function testCreateWrongRow()
    {
        return new Matrix([[1, 2], [3], [7, 9]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage All rows must contain 3 columns.
     */
    public function testCreateWrongRowAgain()
    {
        return new Matrix([[1, 2, 5], [3, 6, 7], [7, 9, 7, 10]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage All rows must contain 3 columns.
     */
    public function testCreateWithEmptyRow()
    {
        return new Matrix([[1, 2, 5], [], [42, 6, 9]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage The matrix must contain at least one row.
     */
    public function testCreateEmptyRows()
    {
        return new Matrix([]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage The matrix must contain at least one column.
     */
    public function testCreateEmptyColumns()
    {
        return new Matrix([[]]);
    }
}
