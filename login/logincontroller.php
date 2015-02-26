<?php
require_once 'login/loginmodel.php';
class LoginController {
	private $loginModel;
	
	public function __construct($username, $password) {
		$this->loginModel = new LoginModel($username, $password);
	}
	
	public function login_submit() {
		$this->loginModel->authorize();
	}
}
?>