<?php

final class User
{
	private $name;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
}

class Admnistrator extends User
{

}

$adm = new Admnistrator();
$adm->setName('Adminitrador');

print $adm->getName();