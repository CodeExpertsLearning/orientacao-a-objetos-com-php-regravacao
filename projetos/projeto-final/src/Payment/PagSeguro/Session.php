<?php
namespace Code\Payment\PagSeguro;

use Code\Session\Session as CodeSession;

class Session
{
	public static function createSession()
	{
		if(!CodeSession::has('pagseguro_session')) {
			$sessionCode = \PagSeguro\Services\Session::create(
				\PagSeguro\Configuration\Configure::getAccountCredentials()
			);

			CodeSession::add('pagseguro_session', $sessionCode->getResult());
		}
	}
}