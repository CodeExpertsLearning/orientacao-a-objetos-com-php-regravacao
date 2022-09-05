<?php

/**
 * __construct , __destruct
 * __set, __get
 * __call, __callStatic
 * __toString
 * e mais: bit.ly/php-metodos-magicos
 */

class Product
{
	private $props = [];
//
	public function __set($name, $value)
	{
		$this->props[$name] = $value;
	}
//
//	public function __get($name)
//	{
//		return  $this->props[$name];
//	}
//	public function __call($name, $params)
//	{
//		print_r([$name, $params]);
//	}
//
//	public static function __callStatic($name, $params)
//	{
//		print_r([$name, $params]);
//	}

	public function __toString()
	{
		return json_encode($this->props);
	}
}

$produto = new Product();
$produto->name = 'Produto 1';
$produto->price = 19.99;

print $produto;