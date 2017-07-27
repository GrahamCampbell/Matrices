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

use PHPUnit\Framework\TestCase;

/**
 * This is the abstract matrix test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
abstract class AbstractMatrixTestCase extends TestCase
{
    abstract protected function createMatrix();

    /**
     * @dataProvider creationProvider
     */
    public function testCreation($count, $rows, $columns, $square)
    {
        $matrix = $this->createMatrix();

        $this->assertCount($count, $matrix);
        $this->assertSame($rows, $matrix->rows());
        $this->assertSame($columns, $matrix->columns());
        $this->assertSame($square, $matrix->square());
    }

    /**
     * @dataProvider rowProvider
     */
    public function testRows($index, array $elements)
    {
        $matrix = $this->createMatrix();

        $row = [];

        foreach ($matrix->row($index) as $key => $element) {
            $row[$key] = $element;
        }

        $this->assertSame($elements, $row);
    }

    /**
     * @dataProvider columnProvider
     */
    public function testColumns($index, array $elements)
    {
        $matrix = $this->createMatrix();

        $column = [];

        foreach ($matrix->column($index) as $key => $element) {
            $column[$key] = $element;
        }

        $this->assertSame($elements, $column);
    }
}
