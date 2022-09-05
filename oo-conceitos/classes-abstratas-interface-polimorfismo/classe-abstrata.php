<?php

abstract class Animal
{
	private $name;

	public function run()
	{
		return "Animal is running...";
	}

	abstract public function sound();
}

class Dog extends Animal
{
	public function sound()
	{
		return "Au au au";
	}
}

$animal = new Dog();
print $animal->run();
print "\n";
print $animal->sound();