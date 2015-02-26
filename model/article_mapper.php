<?php
class ArticleMapper {
	
	function map_to_object($row) {
		$article = new Article();
		$article->set_from_db($row['post_id'], $row['user_id'], $row['username'], $row['title'], $row['content'], $row['date_posted']);
		return $article;
	}
	
	function get_articles($skip) {
		$articles = array();
		$query = "SELECT post_id, post.user_id, username, title, content, date_posted " .
				"FROM post INNER JOIN blogadmin " .
				"ON post.user_id = blogadmin.user_id " .
				"ORDER BY date_posted DESC " .
				"LIMIT $skip , 6";
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$data = mysqli_query($dbc, $query);
		while($row = mysqli_fetch_array($data)) {
			$article = $this->map_to_object($row);
			array_push($articles, $article);
		}
		
		return $articles;
	}
	
	function map_to_db(Article $article) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
		or die('Error querying server.');
		
		$user_id = $article->get_user_id();
		$title = $article->get_title();
		$content = $article->get_content();
		
		$query = "INSERT INTO post (user_id, title, content, date_posted) " .
				"VALUES ($user_id, '$title', '$content', NOW())";
		
		mysqli_query($dbc, $query)
		or die('Error querying server.');
	}
} 
?>