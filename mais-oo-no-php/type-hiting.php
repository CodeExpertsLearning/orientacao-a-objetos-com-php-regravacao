<?php
declare(strict_types=1);

class Product
{
	private $name;
	private $price;

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice(float $price): void
	{
		$this->price = $price;
	}
}

class Cart
{
	private $itens = [];

	public function addProduct(Product $product)
	{
		$this->itens[] = $product;
	}

	public function getItens(): array
	{
		return $this->itens;
	}
}

$product = new Product();
$product->setName("Produto Teste");
$product->setPrice(19.90);

$product2 = new Product();
$product2->setName("Produto Teste 2");
$product2->setPrice(39.90);


$cart = new Cart();
$cart->addProduct($product);
$cart->addProduct($product2);

var_dump($cart->getItens());
//print 'Produto: ' . $product->getName() . ' custa ' . $product->getPrice();