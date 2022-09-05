<?php
namespace Code\DB;

use \PDO;

abstract class Entity
{
	/**
	 * @var PDO
	 */
	private $conn;

	public function __construct(\PDO $conn)
	{
		$this->conn = $conn;
	}

	public function findAll()
	{
		$sql = 'SELECT * FROM products';

		$get = $this->conn->query($sql);

		return $get->fetchAll(PDO::FETCH_ASSOC);
	}

	public function find(int $id)
	{
		$sql =  'SELECT * FROM products WHERE id = :id';

		$get = $this->conn->prepare($sql);
		$get->bindValue(':id', $id, \PDO::PARAM_INT);

		$get->execute();

		return $get->fetch(PDO::FETCH_ASSOC);
	}
}