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

    /**
     * Checking Node existence
     * @param Node $node
     * @return bool
     */
    public function nodeExists(Node $node): bool
    {
        return $node != null && $node->value != null;
    }

    /**
     * Create Node
     * @param Node $node
     * @param int $value
     */
    public function createNode(Node $node, int $value): void
    {
        $node->left  = new Node();
        $node->right = new Node();
        $node->value = $value;
    }

    /**
     * Insert Node
     * @param Node $node
     * @param int $value
     */
    public function insertNode(Node $node, int $value): void
    {
        if (!$this->nodeExists($node)) {
            $this->createNode($node, $value);
        } elseif ($value < $node->value) {
            $this->insertNode($node->left, $value);
        } elseif ($value >= $node->value) {
            $this->insertNode($node->right, $value);
        }
    }
}
