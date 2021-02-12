<?php

declare(strict_types=1);

namespace App;

class Node
{
    /**
     * Node left child
     * @var Node|null
     */
    public ?Node $left = null;
    /**
     * Node right child
     * @var Node|null
     */
    public ?Node $right = null;
    /**
     * Node value
     * @var int|null
     */
    public ?int $value = null;

    /**
     * Node constructor.
     */
    public function __construct()
    {
    }

    /**
     * Insert Node
     * @param Node|null $node
     * @param int $value
     */
    public function insertNode(?Node $node, int $value): void
    {
        if (!$this->nodeExists($node)) {
            $this->createNode($node, $value);
        } elseif ($value < $node->value) {
            $this->insertNode($node->left, $value);
        } elseif ($value >= $node->value) {
            $this->insertNode($node->right, $value);
        }
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
        $node->left = new Node();
        $node->right = new Node();
        $node->value = $value;
    }

    /**
     * Search Node
     * @param Node $node
     * @param int $value
     * @return Node|null
     */
    public function searchNode(Node $node, int $value): ?Node
    {
        $result = null;

        if (!$this->nodeExists($node)) {
            $result = null;
        }
        if ($node->value == $value) {
            $result = $node;
        }
        if ($value < $node->value) {
            $result = $this->searchNode($node->left, $value);
        }
        if ($value > $node->value) {
            $result = $this->searchNode($node->right, $value);
        }
        return $result;
    }

    /**
     * Getting the minimum Node
     * @param Node $node
     * @return Node|null
     */
    public function getMin(Node $node): ?Node
    {
        $result = null;

        if (!$this->nodeExists($node)) {
            $result = null;
        }
        if (!$this->nodeExists($node->left)) {
            $result = $node;
        } else {
            $result = getMin($node->left);
        }

        return $result;
    }

    /**
     * Getting maximum Node
     * @param Node $node
     * @return Node|null
     */
    public function getMax(Node $node): ?Node
    {
        $result = null;

        if (!$this->nodeExists($node)) {
            $result = null;
        }
        if (!$this->nodeExists($node->right)) {
            $result = $node;
        } else {
            $result = getMin($node->right);
        }

        return $result;
    }
}
