<?php

namespace App;

require_once './vendor/autoload.php';

use App\Node;

$node = new Node();
$node->createNode($node, 15);
$node->insertNode($node, 16);
$node->insertNode($node, 14);
$node->insertNode($node, 12);
$node->insertNode($node, 13);
$node->insertNode($node, 17);

var_dump($node->right);
