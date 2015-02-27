<?php
class ArticleMapper {
	
	function map_to_object($row) {
		$article = new Article();
		$article->set_from_db($row['post_id'], $row['user_id'], $row['username'], $row['title'], $row['content'], $row['date_posted']);
		return $article;
	}
	
	function get_articles($skip) {
		$articles = array();
		
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
		try {
			$dbh = new PDO($dsn, DB_USER, DB_PASS);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'Error connecting database: ' . $e->getMessage();
		}
		
		$statement = "SELECT post_id, post.user_id, username, title, content, date_posted " .
				"FROM post INNER JOIN blogadmin " .
				"ON post.user_id = blogadmin.user_id " .
				"ORDER BY date_posted DESC " .
				"LIMIT ? , 6";
		$stmt = $dbh->prepare($statement);
		$stmt->bindParam(1, $sk);
		$sk = $skip;
		$stmt->execute();
		while($row = $stmt->fetch()) {
			$article = $this->map_to_object($row);
			array_push($articles, $article);
		}
		
		$dbh = null;
		
		return $articles;
	}
	
	function map_to_db(Article $article) {
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
		try {
			$dbh = new PDO($dsn, DB_USER, DB_PASS);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Error connecting database: ' . $e->getMessage();
		}
		
		$statement = "INSERT INTO post (user_id, title, content, date_posted) " .
				"VALUES (:user_id, :title, :content, NOW())";
		$stmt = $dbh->prepare($statement);
		
		$stmt->bindParam(':user_id', $user_id);
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':content', $content);
		
		$user_id = $article->get_user_id();
		$title = $article->get_title();
		$content = $article->get_content();
		
		$stmt->execute();
		
		$dbh = null;
	}
} 
?>