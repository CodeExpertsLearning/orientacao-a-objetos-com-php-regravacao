<?php

class BankAccount
{
	private $balance = 0;

	public function __construct()
	{
		$this->balance = 30;
	}

	public function deposit($money)
	{
		$this->balance += $money;
	}

	public function withdraw($money)
	{
		if($money > $this->balance)
			return false;

		$this->balance -= $money;
	}

	public function getBalance()
	{
		return $this->balance;
	}
}

$bankAccount = new BankAccount();
$bankAccount->deposit(10);

$bankAccount->deposit(20);

$bankAccount->withdraw(30);

print $bankAccount->getBalance();