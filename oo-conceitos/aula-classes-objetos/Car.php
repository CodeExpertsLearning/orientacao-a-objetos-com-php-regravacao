<?php

class Car {
	public $color;
	public $year;
	public $model;

	public function run()
	{
		return $this->model . ' car is running...';
	}

	public function stop()
	{
		return $this->model . ' car has stopped...';
	}
}

$car = new Car();
$car->model = 'Corsa';
$car->color = 'white';
$car->year  = 1990;

print $car->run();
print $car->stop();

$car2 = new Car();
$car2->model = 'S10';
$car2->color = 'red';
$car2->year  = 2018;

print $car2->run();
print $car2->stop();

