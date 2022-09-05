<?php
namespace Code\Controller\Admin;


use Ausi\SlugGenerator\SlugGenerator;
use Code\Authenticator\CheckUserLogged;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Session\Flash;
use Code\Security\Validator\Sanitizer;
use Code\Security\Validator\Validator;
use Code\View\View;

class CategoriesController
{

	use CheckUserLogged;

	public function __construct()
	{
		if(!$this->check()) return header('Location: ' . HOME . '/auth/login');
	}

	public function index()
	{
		$view = new View('admin/categories/index.phtml');
		$view->categories = (new Category(Connection::getInstance()))->findAll();

		return $view->render();
	}

	public function new()
	{
		try {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = $_POST;
				$data = Sanitizer::sanitizeData($data, Category::$filters);

				if(!Validator::validateRequiredFields($data)) {
					Flash::add('warning', 'Preencha todos os campos!');
					return header('Location: ' . HOME . '/categories/new');
				}

				$post = new Category(Connection::getInstance());
				$data['slug'] = (new SlugGenerator())->generate($data['name']);

				if(!$post->insert($data)) {
					Flash::add('error', 'Erro ao criar categoria!');
					return header('Location: ' . HOME . '/categories/new');
				}

				Flash::add('success', 'Categoria criada com sucesso!');
				return header('Location: ' . HOME . '/categories');
			}

			$view = new View('admin/categories/new.phtml');
			return $view->render();

		} catch (\Exception $e) {
			if(APP_DEBUG) {
				Flash::add('error', $e->getMessage());
				return header('Location: ' . HOME . '/categories');
			}
			Flash::add('error', 'Ocorreu um problema interno, por favor contacte o admin.');
			return header('Location: ' . HOME . '/categories');
		}
	}

	public function edit($id = null)
	{
		try {
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$data = $_POST;

				$data = Sanitizer::sanitizeData($data, Category::$filters);

				$data['id'] = (int) $id;

				if (!Validator::validateRequiredFields($data)) {
					Flash::add('warning', 'Preencha todos os campos!');

					return header('Location: ' . HOME . '/categories/edit/' . $id);
				}

				$post = new Category(Connection::getInstance());

				if (!$post->update($data)) {
					Flash::add('error', 'Erro ao atualizar categoria!');

					return header('Location: ' . HOME . '/categories/edit/' . $id);
				}

				Flash::add('success', 'Categoria atualizada com sucesso!');

				return header('Location: ' . HOME . '/categories/edit/' . $id);
			}

			$view = new View('admin/categories/edit.phtml');
			$view->category = (new Category(Connection::getInstance()))->find($id);

			return $view->render();

		} catch (\Exception $e) {
			if(APP_DEBUG) {
				Flash::add('error', $e->getMessage());
				return header('Location: ' . HOME . '/categories');
			}
			Flash::add('error', 'Ocorreu um problema interno, por favor contacte o admin.');
			return header('Location: ' . HOME . '/categories');
		}
	}

	public function remove($id = null)
	{
		try{
			$post = new Category(Connection::getInstance());

			if(!$post->delete($id)) {
				Flash::add('error', 'Erro ao realizar remoção do categoria!');
				return header('Location: ' . HOME . '/categories');
			}

			Flash::add('success', 'Categoria removida com sucesso!');
			return header('Location: ' . HOME . '/categories');

		} catch (\Exception $e) {
			if(APP_DEBUG) {
				Flash::add('error', $e->getMessage());
				return header('Location: ' . HOME . '/categories');
			}
			Flash::add('error', 'Ocorreu um problema interno, por favor contacte o admin.');
			return header('Location: ' . HOME . '/categories');
		}
	}
}