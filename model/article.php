<?php
class Article {
	private $post_id;
	private $user_id;
	private $username;
	private $title;
	private $content;
	private $date_posted;
	
	function set_post_id($post_id) {
		$this->post_id = $post_id;
	}
	
	function get_post_id() {
		return $this->post_id;
	}
	
	function set_user_id($user_id) {
		$this->user_id = $user_id;
	}
	
	function get_user_id() {
		return $this->user_id;
	}
	
	function set_username($username) {
		$this->username = $username;
	}
	
	function get_username() {
		return $this->username;
	}
	
	function set_title($title) {
		$this->title = $this->secure($title);
	}
	
	function get_title() {
		return $this->title;
	}
	
	function set_content($content) {
		$formated_content = $this->secure($content);
		$formated_content = $this->html_format($formated_content);
		$this->content = $formated_content;
	}
	
	function get_content() {
		return $this->content;
	}
	
	function set_date_posted($date_posted) {
		$this->date_posted = $date_posted;
	}
	
	function get_date_posted() {
		return $this->date_posted;
	}
	
	function set_from_db($post_id, $user_id, $username, $title, $content, $date_posted) {
		$this->post_id = $post_id;
		$this->user_id = $user_id;
		$this->username = $username;
		$this->title = $title;
		$this->content = $content;
		$this->date_posted = $date_posted;
	}
	
	private function secure($string) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
		or die('Error querying server.');
		$str = mysqli_real_escape_string($dbc, trim($string));
		mysqli_close($dbc);
		return $str;
	}
	
	private function html_format($content) {
		$finalStr = '';
		$conArr = explode('\n', $content);
		foreach ($conArr as $cont) {
			if((substr($cont, 0, 6)) == '<image') {
				$finalStr .= $this->format_image($cont);
			} else {
				$finalStr .= $this->format_par($cont);
			}
		}
		return $finalStr;
	}
	
	private function format_par($string) {
		return '<P>' . $string . '</p>';
	}
	
	private function format_image($string) {
		$start = strpos($string, '=') + 1;
		$end = strpos($string, '>');
		$length = $end - $start;
		$src = substr($string, $start, $length);
		return '<image src="' . $src . '">';
	}
}