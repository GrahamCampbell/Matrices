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
        new Matrix([[1, 2], [3], [7, 9]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage All rows must contain 3 columns.
     */
    public function testCreateWrongRowAgain()
    {
        new Matrix([[1, 2, 5], [3, 6, 7], [7, 9, 7, 10]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage All rows must contain 3 columns.
     */
    public function testCreateWithEmptyRow()
    {
        new Matrix([[1, 2, 5], [], [42, 6, 9]]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage The matrix must contain at least one row.
     */
    public function testCreateEmptyRows()
    {
        new Matrix([]);
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidMatrixException
     * @expectedExceptionMessage The matrix must contain at least one column.
     */
    public function testCreateEmptyColumns()
    {
        new Matrix([[]]);
    }

    public function testGetGoodElement()
    {
        $matrix = new Matrix([[1, 2], [2, 3]]);

        $this->assertSame(2, $matrix->element(1, 0));
    }

    /**
     * @expectedException \GrahamCampbell\Matrices\Exceptions\InvalidElementException
     * @expectedExceptionMessage The given element does not exist in the matrix.
     */
    public function testGetBadElement()
    {
        $matrix = new Matrix([[1, 2], [2, 3]]);

        $matrix->element(42, -7);
    }
}
