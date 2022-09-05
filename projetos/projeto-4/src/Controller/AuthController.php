<?php
namespace Code\Controller;

use Code\Authenticator\Authenticator;
use Code\DB\Connection;
use Code\Entity\User;
use Code\Session\Flash;
use Code\View\View;

class AuthController
{
	public function login()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			var_dump($_POST);
			$user = new User(Connection::getInstance());
			$authenticator = new Authenticator($user);

			if(!$authenticator->login($_POST)) {
				Flash::add("warning","Usuário ou senha incorretos!");
				return header("Location: " . HOME . '/auth/login');
			}

			Flash::add("success","Usuário logado com suceso!");
			return header("Location: " . HOME . '/posts');
		}
		$view = new View('auth/index.phtml');
		return $view->render();
	}

	public function logout()
	{
		$auth = (new Authenticator())->logout();
		Flash::add('success', 'Usuário deslogado com sucesso!');
		return header("Location: " . HOME);
	}
}