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
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
		try {
			$dbh = new PDO($dsn, DB_USER, DB_PASS);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Error connecting db: ' . $e->getMessage();
		}
		$statement = 'SELECT * FROM blogadmin where username = ? AND password = ?';
		
		$stmt = $dbh->prepare($statement);
		$stmt->bindParam(1, $username);
		$stmt->bindParam(2, $password);
		$username = $this->username;
		$password = sha1($this->password);
		$stmt->execute();
		
		if($stmt->rowCount() == 1) {
			$this->start_session($stmt);
			return true;
		} else {
			echo 'Im here';
			echo $username . '<br>' . $password;
		}
		return false;
	}
	private function start_session($stmt) {
		$row = $stmt->fetch();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['username'] = $row['username'];
		setcookie('user_id', $row['user_id'], time() + (7 * 24 * 3600));
		setcookie('username', $row['username'], time() + (7 * 24 * 3600));
	}
}
?>