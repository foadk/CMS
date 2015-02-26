<?php
	
	class ArticleView {
		
		private $articles = array();
		
		public function print_articles() {
			
			$articles_length = sizeof($this->articles);
			
			if($articles_length != 6) {
				$loop_length = $articles_length;
			} else {
				$loop_length = $articles_length - 1;
			}
			for ($i = 0; $i < $loop_length; $i++) {
				$username = $this->articles[$i]->get_username();
				$title = $this->articles[$i]->get_title();
				$content = $this->articles[$i]->get_content();
				$date_posted = $this->articles[$i]->get_date_posted();
				
				$post = '<div class="content"><h1>' . $title . '</h1><p>' . $content . '</p></div>';
				echo $post;
			}
		}
		
		public function set_articles() {
			global $page;
			$skip = 5 * ($page - 1);
			$articleMapper = new ArticleMapper();
			$this->articles = $articleMapper->get_articles($skip);
			$articles_length = sizeof($this->articles);
			
			$this->set_pagenav($articles_length);
		}
		
		private function set_pagenav($length) {
			global $prev;
			global $next;
			global $page;
			if($page == 1) {
				$prev = 0;
			} else {
				$prev = 1;
			}
			
			if($length == 6) {
				$next = 1;
			} else {
				$next = 0;
			}
		}
		
		public function after_submit() {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location:' . $home_url);
		}
	}
?>