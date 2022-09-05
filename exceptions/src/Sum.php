<?php
namespace Code;

use Code\Exceptions\MyCustomException;

class Sum
{
	public function doSum($num1, $num2)
	{
		if($num2 > 10)
//			throw new \InvalidArgumentException("Parâmetro 2 deve ser menor ou igual a 10");
			throw new MyCustomException("Teste...");

		return $num1 + $num2;
	}
}