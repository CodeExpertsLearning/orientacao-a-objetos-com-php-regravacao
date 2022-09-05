<?php

class User
{
	private $name;

	public function getName()
	{
		return $this->name;
	}

	final public function setName($name)
	{
		$this->name = $name;
	}
}

class Admnistrator extends User
{
	public function setName($name)
	{
		return 'Teste';
	}
}

$adm = new Admnistrator();
$adm->setName('Adminitrador');

print $adm->getName();