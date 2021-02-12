<?php

declare(strict_types=1);

namespace App;

class Node
{
    /**
     * Node left child
     * @var Node
     */
    public Node $left;
    /**
     * Node right child
     * @var Node
     */
    public Node $right;
    /**
     * Node value
     * @var int
     */
    public int $value;

    /**
     * Node constructor.
     * @param Node|null $node
     */
    public function __construct()
    {
    }
}
