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
        if (!$this->existNode($node)) {
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
    public function existNode(Node $node): bool
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

        if ($this->existNode($node)) {
            if ($node->value == $value) {
                $result = $node;
            }
            if ($node->value < $value) {
                $result = $this->searchNode($node->right, $value);
            }
            if ($node->value > $value) {
                $result = $this->searchNode($node->left, $value);
            }
        }
        else {
            $result = null;
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

        if (!$this->existNode($node)) {
            $result = null;
        }
        if (!$this->existNode($node->left)) {
            $result = $node;
        } else {
            $result = $this->getMin($node->left);
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

        if (!$this->existNode($node)) {
            $result = null;
        }
        if (!$this->existNode($node->right)) {
            $result = $node;
        } else {
            $result = $this->getMax($node->right);
        }

        return $result;
    }

    /**
     * Convert a multi-dimensional array into a single-dimensional array.
     * @param $items
     * @return array|mixed
     */
    private function arrayFlatten($items): array
    {
        if (!is_array($items)) {
            return [$items];
        }

        return array_reduce($items, function ($carry, $item) {
            return array_merge($carry, $this->arrayFlatten($item));
        }, []);
    }

    /**
     * @param Node $node
     * @return array|null
     */
    public function traversalInOrder(Node $node): ?array
    {
        $result = [];
        if ($this->existNode($node)) {
            array_push($result, $this->traversalInOrder($node->left));
            array_push($result, $node->value);
            array_push($result, $this->traversalInOrder($node->right));
        }
        return $this->arrayFlatten($result);
    }

    /**
     * @param Node $node
     * @return array|null
     */
    public function traversalPostOrder(Node $node): ?array
    {
        $result = [];
        if ($this->existNode($node)) {
            array_push($result, $this->traversalPostOrder($node->left));
            array_push($result, $this->traversalPostOrder($node->right));
            array_push($result, $node->value);
        }

        return $this->arrayFlatten($result);
    }

    /**
     * @param Node $node
     * @return array|null
     */
    public function traversalPreOrder(Node $node): ?array
    {
        $result = [];
        if ($this->existNode($node)) {
            array_push($result, $node->value);
            array_push($result, $this->traversalPreOrder($node->left));
            array_push($result, $this->traversalPreOrder($node->right));
        }

        return $this->arrayFlatten($result);
    }
}
