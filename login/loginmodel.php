<?php
require_once 'connectvars.php';
class LoginModel {
	private $username;
	private $password;
	
	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}
	public function authorize() {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
		or die ('Error connecting DB');
		
		$query = "SELECT * FROM blogadmin where username = '$this->username' AND password = SHA('$this->password')";
		$result = mysqli_query($dbc, $query)
		or die('Error querying server');
		
		if(mysqli_num_rows($result) == 1) {
			$this->start_session($result);
			return true;
		}
		return false;
	}
	private function start_session($result) {
		$row = mysqli_fetch_array($result);
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['username'] = $row['username'];
		setcookie('user_id', $row['user_id'], time() + (7 * 24 * 3600));
		setcookie('username', $row['username'], time() + (7 * 24 * 3600));
	}
}
?>