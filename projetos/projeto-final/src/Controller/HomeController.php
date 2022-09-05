<?php
namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;

class HomeController
{
	public function index()
	{
		$view = new View('site/index.phtml');
		$view->products = (new Product(Connection::getInstance()))->getAllProductsWithThumb();

		return $view->render();
	}
}