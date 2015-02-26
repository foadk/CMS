<?php
class ArticleController {
	
	private $articleHandler;
	
	public function __construct() {
		$this->articleHandler = new ArticleHandler();
	}
	
	public function get_input() {
		$user_id = $_SESSION['user_id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		
		if(empty($title) || empty($content)) {
			return false;
		} else {
			$this->articleHandler->build_article($user_id, $title, $content);
			return true;
		}
	}
}
?>