<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;

/**
 * Class TreeTest
 * @covers \App\Tree
 * @covers \App\Node
 */
class TreeTest extends TestCase
{

    public Node $node;

    /**
     * @covers  \App\Tree::createNode
     * @covers  \App\Tree::insertNode
     * @covers  \App\Tree::searchNode
     * @param int $expected
     * @param int $value
     * @param array $data
     * @dataProvider insertionProvider
     */
    public function testInsertion(int $expected, int $value, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }

        $this->assertEquals($expected, $this->node->searchNode($this->node, $value)->getValue());
    }

    /**
     * @covers  \App\Tree::searchNode
     * @param bool $expected
     * @param int $value
     * @param array $data
     * @dataProvider existenceProvider
     */
    public function testExistence(bool $expected, int $value, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expected, is_null($this->node->searchNode($this->node, $value)));
    }

    /**
     * @covers \App\Tree::getMin
     * @param $expMin
     * @param array $data
     * @dataProvider minProvider
     */
    public function testMin(int $expMin, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expMin, $this->node->getMin($this->node)->getValue());
    }

    /**
     * @covers \App\Tree::getMax
     * @param $expMax
     * @param array $data
     * @dataProvider maxProvider
     */
    public function testMax(int $expMax, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expMax, $this->node->getMax($this->node)->getValue());
    }

    /**
     * @covers \App\Tree::getMax
     * @covers \App\Tree::getMin
     */
    public function testNonExistentNode()
    {
        $this->assertNull($this->node->getMin($this->node)->getValue());
        $this->assertNull($this->node->getMax($this->node)->getValue());
    }

    /**
     * @covers \App\Tree::traversalInOrder
     * @param array $expected
     * @param array $data
     * @dataProvider inorderProvider
     */
    public function testTraversalInOrder(array $expected, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expected, $this->node->traversalInOrder($this->node));
    }

    /**
     * @covers \App\Tree::traversalPostOrder
     * @param array $expected
     * @param array $data
     * @dataProvider postorderProvider
     */
    public function testTraversalPostOrder(array $expected, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expected, $this->node->traversalPostOrder($this->node));
    }

    /**
     * @covers \App\Tree::traversalPreOrder
     * @param array $expected
     * @param array $data
     * @dataProvider preorderProvider
     */
    public function testTraversalPreOrder(array $expected, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expected, $this->node->traversalPreOrder($this->node));
    }

    /**
     * @covers \App\Tree::removeNode
     * @param bool $expected
     * @param int $value
     * @param array $data
     * @dataProvider removeProvider
     */
    public function testRemoveNode(bool $expected, int $value, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expected, $this->node->removeNode($this->node, $value));
    }

    /**
     * @return array
     */
    public function insertionProvider(): array
    {
        return [
            [1, 1, [2, 1, 3 ]],
            [2, 2, [2, 1, 3 ]],
            [3, 3, [2, 1, 3 ]],
            [12, 12, [7, 9, 8, 6, 11, 12, 5, 3, 4 ]],
            [2, 2, [7, 9, 8, 6, 11, 12, 5, 3, 4, 2 ]],
        ];
    }

    /**
     * @return array
     */
    public function minProvider(): array
    {
        return [
            [3, [8, 7, 10, 9, 6, 12, 5, 4 ,15, 3, 18, 17, 21, 19]],
            [2, [7, 9, 8, 6, 11, 12, 5, 3, 4, 2 ]],
            [3, [7, 9, 8, 6, 11, 12, 5, 3, 4 ]],
        ];
    }

    /**
     * @return array
     */
    public function maxProvider(): array
    {
        return [
            [21, [8, 7, 10, 9, 6, 12, 5, 4 ,15, 3, 2, 1, 18, 17, 21, 19]],
            [12, [7, 9, 8, 6, 11, 12, 5, 3, 4, 2 ]],
            [15, [7, 9, 8, 6, 11, 12, 5, 3, 4, 15 ]],
        ];
    }

    /**
     * @return array
     */
    public function existenceProvider(): array
    {
        return [
            [true, 4, [8, 7, 10, 9, 6, 12, 5, 15, 3, 2, 1, 18, 17, 21, 19]],
            [false, 17, [8, 7, 10, 9, 6, 12, 5, 15, 3, 2, 1, 18, 17, 21, 19]],
            [true, 10, [7, 9, 8, 6, 12, 5, 3, 4, 2 ]],
            [false, 3, [7, 9, 8, 6, 12, 5, 3, 4, 2 ]],
            [true, 2, [7, 9, 8, 6, 11, 12, 5, 3, 4, 15 ]],
            [false, 7, [7, 9, 8, 6, 11, 12, 5, 3, 4, 15 ]],
        ];
    }

    public function inorderProvider(): array
    {
        return [
            [[1, 2, 3], [2, 1, 3]],
            [[1, 2, 3, 4, 5, 6, 7], [4, 5, 2, 3, 1, 7, 6]],
            [
                [1, 2, 3, 5, 6, 7, 8 ,9, 10, 12, 15, 17, 18, 19, 21],
                [8, 7, 10, 9, 6, 12, 5, 15, 3, 2, 1, 18, 17, 21, 19]
            ],
        ];
    }

    public function postorderProvider(): array
    {
        return [
            [[1, 3, 2],[2, 1, 3]],
            [[1, 3, 2, 6, 7, 5, 4], [4, 5, 2, 3, 1, 7, 6]],
            [
                [1, 2, 3, 5, 6, 7, 9, 17, 19, 21, 18, 15, 12, 10, 8],
                [8, 7, 10, 9, 6, 12, 5, 15, 3, 2, 1, 18, 17, 21, 19]
            ],
        ];
    }

    public function preorderProvider(): array
    {
        return [
            [[2, 1, 3],[2, 1, 3]],
            [[4, 2, 1, 3, 5, 7, 6], [4, 5, 2, 3, 1, 7, 6]],
            [
                [8, 7, 6, 5, 3, 2, 1, 10, 9, 12, 15, 18, 17, 21, 19],
                [8, 7, 10, 9, 6, 12, 5, 15, 3, 2, 1, 18, 17, 21, 19]
            ],
        ];
    }

    public function removeProvider(): array
    {
        return [
            [true, 1, [2, 1, 3]],
            [true, 3, [2, 1, 3]],
            [true, 2, [2, 1, 3]],
            [true, 5, [4, 5, 7, 6, 2, 1, 3]],
            [true, 7, [4, 5, 7, 6, 2, 1, 3]],
            [false, 8, [4, 5, 7, 6, 2, 1, 3]],
        ];
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->node = new Tree();
    }

    public function tearDown(): void
    {
        unset($this->node);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
