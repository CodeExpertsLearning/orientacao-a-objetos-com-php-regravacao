<?php
namespace Code\Controller;

use Code\Authenticator\CheckUserLogged;
use Code\DB\Connection;
use Code\Entity\UserOrder;
use Code\Session\Session;
use Code\View\View;

class OrdersController
{
	use CheckUserLogged;

	public function my()
	{
		if(!$this->check()) return header('Location: ' . HOME);

		$userId = Session::get('user')['id'];

		$userOrders = (new UserOrder(Connection::getInstance()))->where(['user_id' => $userId]);

		$view = new View('site/my_orders.phtml');
		$view->userOrders = $userOrders;

		return $view->render();
	}
}