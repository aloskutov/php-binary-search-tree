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
     * @param int|null $value
     */
    public function setValue(?int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param Node|null $left
     */
    public function setLeft(?Node $left)
    {
        $this->left = $left;
    }

    /**
     * @return Node|null
     */
    public function getLeft(): ?Node
    {
        return $this->left;
    }

    /**
     * @param Node|null $right
     */
    public function setRight(?Node $right)
    {
        $this->right = $right;
    }

    /**
     * @return Node|null
     */
    public function getRight(): ?Node
    {
        return $this->right;
    }
}
