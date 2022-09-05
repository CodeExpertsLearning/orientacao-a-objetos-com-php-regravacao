<?php
trait MyTrait
{
	public function hello()
	{
		return 'Hello World';
	}

	protected function test()
	{
		return 'test';
	}
}

trait MyTrait2 {
	public function showName($name)
	{
		return 'Hello, ' . $name;
	}

	public function hello()
	{
		return 'Hello World 2';
	}
}

class Client
{
	use MyTrait, MyTrait2{
		MyTrait2::hello insteadof MyTrait;
		MyTrait::hello as helloMy;
		//Abaixo estou modificando a visibilidade do método da trait MyTrait
		MyTrait::hello as private helloVisibilityChanged;
	}

	public function test()
	{
		print $this->test();
		return $this->helloVisibilityChanged();
	}
}

$c = new Client();
print $c->hello(); // Método hello vindo da MyTrait2
print '<br>';
print $c->helloMy(); // Alias para o método hello da MyTrait
print '<br>';
print $c->showName('Nanderson');

