<?php
namespace Code\Controller;

use Code\View\View;

class HomeController
{
	public function index()
	{
		$view = new View('site/index.phtml');
		return $view->render();
	}
}