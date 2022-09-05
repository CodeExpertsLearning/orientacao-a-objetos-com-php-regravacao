<?php
namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;

class ProductController
{
	public function index($id)
	{
		$id = (int) $id;

		$pdo = Connection::getInstance();

		$view = new View('site/single.phtml');

		$view->product = (new Product($pdo))->find($id);

		return $view->render();
	}
}