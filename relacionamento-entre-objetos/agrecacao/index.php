<?php
require __DIR__ . '/Cart.php';
require __DIR__ . '/Product.php';

$p1 = new Product();
$p1->setId(1);
$p1->setName('Notebook DELL XPS');
$p1->setPrice(4.999);

$p2 = new Product();
$p2->setId(2);
$p2->setName('Mousepad Logitech');
$p2->setPrice(4);

$cart = new Cart();
$cart->addItem($p1);
$cart->addItem($p2);


foreach($cart->getItens() as $item) {
	print $item->getId() .' ' . $item->getName() . ' ' . $item->getPrice() . "\n";
}



