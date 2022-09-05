<?php

class Cart
{
	private $itens;

	public function addItem(Product $product)
	{
		$this->itens[] = $product;
	}

	public function getItens()
	{
		return $this->itens;
	}
}