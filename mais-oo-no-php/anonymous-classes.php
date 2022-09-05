<?php

$classAnonymous = '';

class BankAccount
{
	public function withdraw($value, $classAnonymous)
	{
		return $classAnonymous->log('Logging withdraw...');
	}
}

$bkAccount = new BankAccount();
print $bkAccount->withdraw(19, new class{
	public function log($message) {
		return $message;
	}
});