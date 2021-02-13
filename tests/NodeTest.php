<?php

declare(strict_types=1);

use App\Node;
use PHPUnit\Framework\TestCase;

/**
 * Class NodeTest
 * @covers \App\Node
 */
class NodeTest extends TestCase
{

    public Node $node;

    /**
     * @covers       \App\Node::createNode
     * @covers       \App\Node::insertNode
     * @covers       \App\Node::searchNode
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

        $this->assertEquals($expected, $this->node->searchNode($this->node, $value)->value);
    }

    /**
     * @covers       \App\Node::searchNode
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
     * @covers \App\Node::getMin
     * @param $expMin
     * @param array $data
     * @dataProvider minProvider
     */
    public function testMin(int $expMin, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expMin, $this->node->getMin($this->node)->value);
    }

    /**
     * @covers \App\Node::getMax
     * @param $expMax
     * @param array $data
     * @dataProvider maxProvider
     */
    public function testMax(int $expMax, array $data)
    {
        foreach ($data as $item) {
            $this->node->insertNode($this->node, $item);
        }
        $this->assertEquals($expMax, $this->node->getMax($this->node)->value);
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

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->node = new Node();
    }

    public function tearDown(): void
    {
        unset($this->node);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
