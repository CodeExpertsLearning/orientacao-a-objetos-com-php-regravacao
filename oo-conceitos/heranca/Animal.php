<?php

class Animal
{
	public $name;

	public function sleep()
	{
		return $this->name . ' are sleeping...';
	}
}


class Dog extends Animal
{
	public $name = 'Dog';

    public function sleep()
    {
	    print parent::sleep() . "\n";
	    return 'Dog are sleeping';
    }
}

class Bird extends  Animal
{

}

$dog = new Dog();
//$dog->name = 'Ted';

print $dog->sleep();

print "\n";

$bird = new Bird();
$bird->name = 'Bird';

print $bird->sleep();