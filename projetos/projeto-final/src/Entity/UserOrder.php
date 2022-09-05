<?php
/**
 * Created by PhpStorm.
 * User: NandoKstroNet
 * Date: 05/02/20
 * Time: 15:25
 */

namespace Code\Entity;

use Code\DB\Entity;

class UserOrder extends Entity
{
	protected $table = 'user_orders';

	public function createOrder(array $data = [])
	{
		return $this->insert($data);
	}
}