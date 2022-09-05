<?php

interface Animal {
	public function sound();
	public function run($name);
}

class Dog implements Animal
{
	public function sound()
	{
		return 'Au au au';
	}

	public function run($name)
	{
		return "Dog is running...";
	}
}


$dog = new Dog();

print $dog instanceof Animal;

//print $dog->run();
//print "\n";
//print $dog->sound();