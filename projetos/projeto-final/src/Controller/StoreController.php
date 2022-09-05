<?php
namespace Code\Controller;

use Code\Entity\User;
use Code\DB\Connection;
use Code\Authenticator\Authenticator;
use Code\View\View;
use Code\Session\{Session, Flash};
use Code\Security\Validator\{Sanitizer, Validator};
use Code\Security\PasswordHash;

class StoreController
{
	public function login()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$user = new User(Connection::getInstance());
			$authenticator = new Authenticator($user);

			if(!$authenticator->login($_POST)) {
				Flash::add("warning", "Usuário ou senha incorretos!");
				return header("Location: " . HOME . '/store/login');
			}

			return header("Location: " . HOME . '/checkout');
		}

		$view = new View('site/login.phtml');
		return $view->render();
	}

	public function register()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = $_POST;
			$data = Sanitizer::sanitizeData($data, User::$filters);

			if(!Validator::validateRequiredFields($data)) {
				Flash::add('warning', 'Preencha todos os campos!');
				return header('Location: ' . HOME . '/store/login');
			}

			if(!Validator::validatePasswordMinStringLenght($data['password'])) {
				Flash::add('warning', 'Senha deve conter pelo menos 6 caracteres!');
				return header('Location: ' . HOME . '/store/login');
			}

			if(!Validator::validatePasswordConfirm($data['password'], $data['password_confirm'])) {
				Flash::add('warning', 'Senhas não conferem!');
				return header('Location: ' . HOME . '/store/login');
			}


			$post = new User(Connection::getInstance());

			$data['password']  = PasswordHash::hash($data['password']);
			$data['is_active'] = 1;

			unset($data['password_confirm']);

			if(!$user = $post->insert($data)) {
				Flash::add('error', 'Erro ao criar usuário!');
				return header('Location: ' . HOME . '/store/login');
			}

			unset($user['password']);

			Session::add('user', $user);
			return header('Location: ' . HOME . '/cart/checkout');
		}
	}
}