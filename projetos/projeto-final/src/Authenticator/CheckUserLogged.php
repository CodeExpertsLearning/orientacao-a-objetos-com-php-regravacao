<?php
namespace Code\Authenticator;

use Code\Session\Session;

trait CheckUserLogged
{
	public function check()
	{
		return Session::has('user');
	}
}