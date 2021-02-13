<?php

namespace App;

require_once './vendor/autoload.php';

$node = new Tree();
$node->createNode($node, 15);
$node->insertNode($node, 16);
$node->insertNode($node, 14);
$node->insertNode($node, 12);
$node->insertNode($node, 13);
$node->insertNode($node, 17);

//var_dump($node->traversalInOrder($node));
//var_dump($node->traversalPostOrder($node));
//var_dump($node->traversalPreOrder($node));

var_dump($node->getMax($node)->value);
