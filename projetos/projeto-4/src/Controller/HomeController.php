<?php
namespace Code\Controller;

use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Post;
use Code\View\View;
use Code\Entity\Product;

class HomeController
{
	public function index()
	{
		$pdo = Connection::getInstance();

		$view = new View('site/index.phtml');
		$view->posts = (new Post($pdo))->findAll();
		$view->categories = (new Category($pdo))->findAll('name, slug');

		return $view->render();
	}
}