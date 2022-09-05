<?php
namespace Code\Authenticator;

use Code\Entity\User;
use Code\Session\Session;

class Authenticator
{
	/**
	 * @var User
	 */
	private $user;

	public function __construct(User $user = null)
	{
		$this->user = $user;
	}

	public function login(array $credentials)
	{
		$user = current($this->user->where([
			'email' => $credentials['email'],
		]));

		if(!$user){
			return false;
		}
		if($user['password'] != $credentials['password']) {
			return false;
		}

		unset($user['password']);
		Session::add('user', $user);
		return true;
	}

	public function logout()
	{
		if(Session::has('user')) {
			Session::remove('user');
		}
		Session::clear();
	}
}