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
use GrahamCampbell\Matrices\Operations\MultiplyCollectionOperation;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * This is the multiply collection operation test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MultiplyCollectionOperationTest extends TestCase
{
    public function testMultiplyCollection()
    {
        $matrices = [new Matrix([[1, 2], [3, 4]]), new Matrix([[5, 6], [7, 8]])];

        $matrix = MultiplyCollectionOperation::apply(new Collection($matrices));

        var_dump($matrix);
    }
}
