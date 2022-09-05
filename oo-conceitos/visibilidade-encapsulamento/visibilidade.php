<?php
//public
//protected
//private

class Person
{
	public $name;
	private $age = 30;

	public function showName()
	{
		return $this->name;
	}
	public function shownAge()
	{
		return $this->age;
	}
}

class Woman extends Person
{
	public function showWomanAge()
	{
		return $this->shownAge();
	}
}

$person = new Person();
$person->name = 'Nanderson';
//$person->age  = 28;

print $person->name;
print "\n";

$woman = new Woman();
print $woman->showWomanAge();