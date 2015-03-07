<?php

/*
 * This file is part of Matrices.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Matrices\Operations;

use GrahamCampbell\Matrices\Collection;
use GrahamCampbell\Matrices\Matrix;
use GrahamCampbell\Matrices\Operations\AddCollectionOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the add collection operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class AddCollectionOperationTest extends TestCase
{
    public function testAddingOneByOne()
    {
        $matrices = [new Matrix([[7.1]]), new Matrix([[4.2]])];
        $matrix = AddCollectionOperation::apply(new Collection($matrices));

        $this->assertSame([[11.3]], $matrix->raw());
    }

    public function testAddingOneByOneManyTimes()
    {
        $matrices = [new Matrix([[0]]), new Matrix([[2]]), new Matrix([[4]]), new Matrix([[-9]])];
        $matrix = AddCollectionOperation::apply(new Collection($matrices));

        $this->assertSame([[-3]], $matrix->raw());
    }

    public function testAddingTwoByTwo()
    {
        $matrices = [new Matrix([[2, 6.1], [7, 9.6]]), new Matrix([[4.1, 1], [-6, 0]])];
        $matrix = AddCollectionOperation::apply(new Collection($matrices));

        $this->assertSame([[6.1, 7.1], [1, 9.6]], $matrix->raw());
    }

    public function testAddingSomeMore()
    {
        $matrices = [new Matrix([[1, 2], [3, 4], [5, 6], [7, 8]]), new Matrix([[8, 7], [6, 5], [4, 3], [2, 1]])];
        $matrix = AddCollectionOperation::apply(new Collection($matrices));

        $this->assertSame([[9, 9], [9, 9], [9, 9], [9, 9]], $matrix->raw());
    }
}
