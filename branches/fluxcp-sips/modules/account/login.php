<?php
if (!defined('FLUX_ROOT')) exit;

$title = 'Log In';

if (count($_POST)) {
	$server   = $params->get('server');
	$username = $params->get('username');
	$password = $params->get('password');
	
	try {
		$session->login($server, $username, $password);
		$returnURL = $params->get('return_url');
		
		if ($returnURL) {
			$this->redirect($returnURL);
		}
		else {
			$this->redirect();
		}
	}
	catch (Flux_LoginError $e) {
		switch ($e->getCode()) {
			case Flux_LoginError::UNEXPECTED:
				$errorMessage = Flux::message('UnexpectedLoginError');
				break;
				
			case Flux_LoginError::INVALID_SERVER:
				$errorMessage = Flux::message('InvalidLoginServer');
				break;
				
			case Flux_LoginError::INVALID_LOGIN:
				$errorMessage = Flux::message('InvalidLoginCredentials');
				break;
				
			case Flux_LoginError::BANNED:
				$errorMessage = Flux::message('TemporarilyBanned');
				break;
				
			case Flux_LoginError::PERMABANNED:
				$errorMessage = Flux::message('PermanentlyBanned');
				break;
				
			default:
				$errorMessage = Flux::message('CriticalLoginError');
				break;
		}
	}
}

$serverNames = $this->getServerNames();
?>