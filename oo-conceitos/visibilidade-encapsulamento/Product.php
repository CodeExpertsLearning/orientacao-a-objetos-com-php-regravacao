<?php

class Product
{
	private $name;
	private $price;
	private $description;
	private $category;

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param mixed $price
	 */
	public function setPrice( $price ) {
		$this->price = $price;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param mixed $category
	 */
	public function setCategory( $category ) {
		$this->category = $category;
	}


}

$product = new Product();
$product->setName('Curso PHP OO');
$product->setPrice(19.99);
$product->setDescription('PHP OO Curso');
$product->setCategory('Cursos de PHP');

print $product->getName() . ' ' . $product->getPrice();