<?php

declare(strict_types=1);

namespace App;

use JetBrains\PhpStorm\Pure;

class Tree extends Node
{
    /**
     * Insert Node
     * @param Node|null $node
     * @param int $value
     */
    public function insertNode(?Node $node, int $value): void
    {
        if (!$this->existNode($node)) {
            $this->createNode($node, $value);
        } elseif ($value < $node->getValue()) {
            $this->insertNode($node->getLeft(), $value);
        } elseif ($value >= $node->getValue()) {
            $this->insertNode($node->getRight(), $value);
        }
    }

    /**
     * Checking Node existence
     * @param Node|null $node
     * @return bool
     */
    #[Pure] public function existNode(?Node $node): bool
    {
        return $node != null && $node->getValue() != null;
    }

    /**
     * Create Node
     * @param Node $node
     * @param int $value
     */
    public function createNode(Node $node, int $value): void
    {
        $node->setLeft(new Node());
        $node->setRight(new Node());
        $node->setValue($value);
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
            if ($node->getValue() == $value) {
                $result = $node;
            }
            if ($node->getValue() < $value) {
                $result = $this->searchNode($node->getRight(), $value);
            }
            if ($node->getValue() > $value) {
                $result = $this->searchNode($node->getLeft(), $value);
            }
        } else {
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
        if (!$this->existNode($node->getLeft())) {
            $result = $node;
        } else {
            $result = $this->getMin($node->getLeft());
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
        if (!$this->existNode($node->getRight())) {
            $result = $node;
        } else {
            $result = $this->getMax($node->getRight());
        }

        return $result;
    }

    /**
     * Convert a multi-dimensional array into a single-dimensional array.
     * @param $items
     * @return array|mixed
     */
    private function arrayFlatten($items): ?array
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
            array_push($result, $this->traversalInOrder($node->getLeft()));
            array_push($result, $node->getValue());
            array_push($result, $this->traversalInOrder($node->getRight()));
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
            array_push($result, $this->traversalPostOrder($node->getLeft()));
            array_push($result, $this->traversalPostOrder($node->getRight()));
            array_push($result, $node->getValue());
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
            array_push($result, $node->getValue());
            array_push($result, $this->traversalPreOrder($node->getLeft()));
            array_push($result, $this->traversalPreOrder($node->getRight()));
        }
        return $this->arrayFlatten($result);
    }

    /**
     * @param Node $toNode
     * @param Node $fromNode
     */
    private function transplantNode(Node $toNode, Node $fromNode)
    {
        $toNode->setValue($fromNode->getValue());
        $toNode->setLeft($fromNode->getLeft());
        $toNode->setRight($fromNode->getRight());
    }

    /**
     * @param Node $node
     * @return int
     */
    private function getChildrenCount(Node $node): int
    {
        $count = 0;

        if ($this->existNode($node->getLeft())) {
            ++$count;
        }
        if ($this->existNode($node->getRight())) {
            ++$count;
        }
        return $count;
    }

    /**
     * @param Node $node
     * @return Node|null
     */
    private function getChildOrNull(Node $node): ?Node
    {
        return $this->existNode($node->getLeft())
            ? $node->getLeft()
            : $node->getRight();
    }

    /**
     * @param Node $nodeToDelete
     */
    private function deleteNodeWithOneOrZeroChild(Node $nodeToDelete)
    {
        $childOrNull = $this->getChildOrNull($nodeToDelete);
        $this->transplantNode($nodeToDelete, $childOrNull);
    }

    /**
     * remove Node
     * @param Node $root
     * @param int $value
     * @return bool
     */
    public function removeNode(Node $root, int $value): bool
    {
        $result = false;

        $nodeToDelete = $this->searchNode($root, $value);

        if ($this->existNode($nodeToDelete)) {
            $childrenCount = $this->getChildrenCount($nodeToDelete);
            if ($childrenCount < 2) {
                $this->deleteNodeWithOneOrZeroChild($nodeToDelete);
            } else {
                $minNode = $this->getMin($nodeToDelete->getRight());
                $nodeToDelete->setValue($minNode->getValue());
                $this->deleteNodeWithOneOrZeroChild($minNode);
            }
            $result = true;
        }
        return $result;
    }
}
