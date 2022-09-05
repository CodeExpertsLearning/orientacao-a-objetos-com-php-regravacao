<?php

class Car {
	public $color;
	public $year;
	public $model;

	public function __construct($color, $year, $model)
	{
		$this->color  = $color;
		$this->year   = $year;
		$this->model  = $model;
	}

	public function run()
	{
		return $this->model . ' car is running...';
	}

	public function stop()
	{
		return $this->model . ' car has stopped...';
	}

	public function __destruct()
	{
		print 'Removing object ' . __CLASS__;
	}
}

$car = new Car("white", 1990, "Corsa");
print $car->model;
//$car->model = 'Corsa';
//$car->color = 'white';
//$car->year  = 1990;

//print $car->run();
//print $car->stop();

$car2 = new Car("red", 2018, "S10");
print $car2->model;
//$car2->model = 'S10';
//$car2->color = 'red';
//$car2->year  = 2018;

//print $car2->run();
//print $car2->stop();

