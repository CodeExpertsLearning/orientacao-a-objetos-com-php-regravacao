<?php
namespace Code\Controller\Admin;

use Code\Authenticator\CheckUserLogged;
use Ausi\SlugGenerator\SlugGenerator;
use Code\DB\Connection;
use Code\Entity\Category;
use Code\Entity\Product;
use Code\Entity\ProductCategory;
use Code\Entity\ProductImage;
use Code\Security\Validator\Sanitizer;
use Code\Security\Validator\Validator;
use Code\Session\Flash;
use Code\Upload\Upload;
use Code\View\View;

class ProductsController
{
	use CheckUserLogged;

	public function __construct()
	{
		if (!$this->check()) return header('Location: ' . HOME . '/auth/login');
	}

	public function index()
	{
		$view = new View('admin/products/index.phtml');

		$view->products = (new Product(Connection::getInstance()))->findAll();

		return $view->render();
	}

	public function new()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = $_POST;

			try {
				$categories = $data['categories'];

				$images = $_FILES['images'];

				$data = Sanitizer::sanitizeData($data, Product::$filters);

				if(!Validator::validateRequiredFields($data)) {
					Flash::add('warning', 'Preencha todos os campos!');
					return header('Location: ' . HOME . '/admin/products/new');
				}

				$data['slug']  = (new SlugGenerator())->generate($data['name']);
				$data['price'] = str_replace('.', '', $data['price']);
				$data['price'] = str_replace(',', '.', $data['price']);
				$data['is_active'] = $data['is_active'] == 'A' ? 1 : 0;

				$product = new Product(Connection::getInstance());
				$productId = $product->insert($data);

				if(!$productId) {
					Flash::add('error', 'Erro ao criar produto!');
					return header('Location: ' . HOME . '/admin/products/new');
				}

				if(isset($images['name'][0]) && $images['name'][0]) {

					if(!Validator::validateImagesFile($images)) {
						Flash::add('error', 'Imagens enviados não são válidas!');
						return header('Location: ' . HOME . '/admin/products/new');
					}

					$upload = new Upload();
					$upload->setFolder(UPLOAD_PATH . '/products/');
					$images = $upload->doUpload($images);

					foreach ($images as $image) {
						$imagesData = [];
						$imagesData['product_id'] = $productId;
						$imagesData['image'] = $image;

						$productImages = new ProductImage(Connection::getInstance());
						$productImages->insert($imagesData);
					}
				}

				if(count($categories)) {

					foreach($categories as $category) {
						$productCategory = new ProductCategory(Connection::getInstance());
						$productCategory->insert([
							'product_id' => $productId,
							'category_id' => $category
						]);
					}
				}


				Flash::add('success', 'Produto criado com sucesso!');
				return header('Location: ' . HOME . '/admin/products');

			} catch (\Exception $e) {
				if(APP_DEBUG) {
					Flash::add('warning', $e->getMessage());
					return header('Location: ' . HOME . '/admin/products/new');
				}

				Flash::add('warning', 'Erro ao salvar produto na loja!');
				return header('Location: ' . HOME . '/admin/products/new');
			}
		}

		$view = new View('admin/products/new.phtml');
		$view->categories = (new Category(Connection::getInstance()))->findAll();

		return $view->render();
	}

	public function edit($id = null)
	{

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			try{
				$data = $_POST;
				$images = $_FILES['images'];
				$categories = $data['categories'];

				$data = Sanitizer::sanitizeData($data, Product::$filters);

				if(!Validator::validateRequiredFields($data)) {
					Flash::add('warning', 'Preencha todos os campos!');
					return header('Location: ' . HOME . '/admin/products/edit/' . $id);
				}

				$data['id'] = (int) $id;
				$data['price'] = str_replace('.', '', $data['price']);
				$data['price'] = str_replace(',', '.', $data['price']);

				$data['is_active'] = $data['is_active'] == 'A' ? 1 : 0;


				$product = new Product(Connection::getInstance());

				if(!$product->update($data)) {
					Flash::add('error', 'Erro ao atualizar produto!');
					return header('Location: ' . HOME . '/admin/products/edit/' . $id);
				}

				$productCategory = new ProductCategory(Connection::getInstance());
				$productCategory->sync($id, $categories);

				if(isset($images['name'][0]) && $images['name'][0]) {

					if(!Validator::validateImagesFile($images)) {
						Flash::add('error', 'Imagens enviados não são válidas!');
						return header('Location: ' . HOME . '/admin/products/edit/' . $id);
					}

					$upload = new Upload();
					$upload->setFolder(UPLOAD_PATH . '/products/');
					$images = $upload->doUpload($images);

					foreach ($images as $image) {
						$imagesData = [];
						$imagesData['product_id'] = $id;
						$imagesData['image'] = $image;

						$productImages = new ProductImage(Connection::getInstance());
						$productImages->insert($imagesData);
					}
				}

				Flash::add('success', 'Produto atualizado com sucesso!');
				return header('Location: ' . HOME . '/admin/products/edit/' . $id);

			} catch (\Exception $e) {
				if(APP_DEBUG) {
					Flash::add('warning', $e->getMessage());
					return header('Location: ' . HOME . '/admin/products/edit/' . $id);
				}

				Flash::add('warning', 'Erro ao atualizar produto na loja!');
				return header('Location: ' . HOME . '/admin/products/edit/' . $id);
			}
		}

		$view = (new View('admin/products/edit.phtml'));
		$view->product = (new Product(Connection::getInstance()))->getProductWithImagesById($id);

		$view->productCategories = (new ProductCategory(Connection::getInstance()))->where(['product_id' => $id]);
		$view->productCategories = array_map(function($line){
			return $line['category_id'];
		}, $view->productCategories);

		$view->categories = (new Category(Connection::getInstance()))->findAll();

		return $view->render();
	}

	public function remove($id = null)
	{
		try{
			$post = new Product(Connection::getInstance());

			if(!$post->delete($id)) {
				Flash::add('error', 'Erro ao realizar remoção do produto!');
				return header('Location: ' . HOME . '/admin/products');
			}

			Flash::add('success', 'Produto removido com sucesso!');
			return header('Location: ' . HOME . '/admin/products');

		} catch (\Exception $e) {
			if(APP_DEBUG) {
				Flash::add('error', $e->getMessage());
				return header('Location: ' . HOME . '/admin/products');
			}
			Flash::add('error', 'Ocorreu um problema interno, por favor contacte o admin.');
			return header('Location: ' . HOME . '/admin/products');
		}
	}
}