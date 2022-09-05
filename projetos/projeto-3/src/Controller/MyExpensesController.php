<?php
namespace Code\Controller;

use Code\Authenticator\CheckUserLogged;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Expense;
use Code\Entity\User;
use Code\Session\Session;
use Code\View\View;

class MyExpensesController
{
	use CheckUserLogged;

	public function __construct()
	{
		if(!$this->check()) {
			die("Usuário não logado!");
		}
	}

	public function index()
	{
		$userId = Session::get('user')['id'];
		$view = new View('expenses/index.phtml');
		$view->expenses = (new Expense(Connection::getInstance()))
						  ->where(['users_id' => $userId]);

		return $view->render();
	}

	public function new()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$connection = Connection::getInstance();
		if($method == 'POST') {
			$data = $_POST;
			$data['users_id'] = Session::get('user')['id'];
			$expense = new Expense($connection);
			$expense->insert($data);

			return header('Location: ' . HOME . '/myexpenses');
		}

		$view = new View('expenses/new.phtml');

		$view->categories = (new Category($connection))->findAll();
		$view->users = (new User($connection))->findAll();

		return $view->render();
	}

	public function edit($id)
	{
		$view = new View('expenses/edit.phtml');
		$method = $_SERVER['REQUEST_METHOD'];
		$connection = Connection::getInstance();

		if($method == 'POST') {
			$data = $_POST;
			$data['id'] = $id;

			$expense = new Expense($connection);
			$expense->update($data);

			return header('Location: ' . HOME . '/myexpenses');
		}

		$view->categories = (new Category($connection))->findAll();
		$view->users = (new User($connection))->findAll();
		$view->expense = (new Expense($connection))->find($id);

		return $view->render();
	}

	public function remove($id)
	{
		$expense = new Expense(Connection::getInstance());
		$expense->delete($id);

		return header('Location: ' . HOME . '/myexpenses');
	}

}