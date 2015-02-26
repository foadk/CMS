<?php
require_once 'model/article.php';

class ArticleHandler {
	
	private $article;
	private $articleMapper;
	
	public function __construct() {
		$this->article = new Article();
		$this->articleMapper = new ArticleMapper();
	}
	
	public function build_article($user_id, $title, $content) {

		$this->article->set_user_id($user_id);
		$this->article->set_title($title);
		$this->article->set_content($content);
		$this->articleMapper->map_to_db($this->article);
	}
}
?>