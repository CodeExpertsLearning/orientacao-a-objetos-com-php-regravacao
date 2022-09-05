<?php

function showBadgeByPagSeguroStatus($status)
{
	switch ($status) {
		case 3:
			return ['class' => 'success', 'status_text' => 'Pago'];
		case 7:
			return ['class' => 'danger', 'status_text' => 'Devolvido'];
		default:
			return ['class' => 'warning', 'status_text' => 'Aguardando Pagamento'];
	}
}