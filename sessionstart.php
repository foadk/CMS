<?php
session_start();
if(isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
	$_SESSION['user_id'] = $_COOKIE['user_id'];
	$_SESSION['username'] = $_COOKIE['username'];
}
/*
if(!isset($_SESSION['user_id'])) {
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	header('Location: ' . $home_url);
}
*/
?>