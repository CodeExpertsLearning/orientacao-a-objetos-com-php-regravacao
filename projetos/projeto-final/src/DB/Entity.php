<?php
namespace Code\DB;

use \PDO;

abstract class Entity
{
	/**
	 * @var PDO
	 */
	protected $conn;

	protected $table;

	protected $timestamps = true;

	public function __construct(\PDO $conn)
	{
		$this->conn = $conn;
	}

	public function findAll($fields = '*'): array
	{
		$sql = 'SELECT ' . $fields . ' FROM ' . $this->table;

		$get = $this->conn->query($sql);

		return $get->fetchAll(PDO::FETCH_ASSOC);
	}

	public function find(int $id, $fields = '*'): array
	{
		return $this->where(['id' => $id], '', $fields);
	}

	public function where(array $conditions, $operator = ' AND ', $fields = '*') : array
	{
		$sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE ';

		$binds = array_keys($conditions);

		$where  = null;
		foreach($binds as $v) {
			if(is_null($where)) {
				$where .= $v . ' = :' . $v;
			} else {
				$where .= $operator . $v . ' = :' . $v;
			}
		}

		$sql .= $where;

		$get = $this->bind($sql, $conditions);
		$get->execute();

		if(!$get->rowCount()) {
			throw new \Exception("Nada encontrado para esta consulta!");
		}

		if($get->rowCount() == 1) return $get->fetch(\PDO::FETCH_ASSOC);

		return $get->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function insert($data): array
	{
		$binds = array_keys($data);

		$timestampFileds = $this->timestamps ? ', created_at, updated_at' : '';
		$timestampValues = $this->timestamps ? ', NOW(), NOW()' : '';

		$sql = 'INSERT INTO ' . $this->table . '('. implode(', ', $binds) . $timestampFileds . '
				) VALUES(:' . implode(', :', $binds) . $timestampValues .')';

		$insert = $this->bind($sql, $data);

		$insert->execute();

		return $this->find($this->conn->lastInsertId());
	}

	public function update($data): bool
	{
		if(!array_key_exists('id', $data)) {
			throw new \Exception('É preciso informar um ID válido para update!');
		}

		$sql = 'UPDATE ' . $this->table . ' SET ';

		$set = null;
		$binds = array_keys($data);

		foreach($binds as $v) {
			if($v !== 'id') {
				$set .= is_null($set) ? $v . ' = :' . $v : ', ' .  $v . ' = :' . $v ;
			}
		}
		$sql .= $set . ', updated_at = NOW() WHERE id = :id';

		$update = $this->bind($sql, $data);

		return $update->execute();
	}

	public function delete($id): bool
	{
		if(is_array($id)) {
			$bind = $id;
			$field = array_keys($id)[0];
		} else {
			$bind = ['id' => $id];
			$field = 'id';
		}

		$sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :' . $field;

		$delete = $this->bind($sql, $bind);

		return $delete->execute();
	}

	private function bind($sql, $data)
	{
		$bind = $this->conn->prepare($sql);

		foreach ($data as $k => $v) {
			gettype($v) == 'int' ? $bind->bindValue(':' . $k, $v, \PDO::PARAM_INT)
				: $bind->bindValue(':' . $k, $v, \PDO::PARAM_STR);
		}

		return $bind;
	}
}