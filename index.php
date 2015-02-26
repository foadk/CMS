<?php
require_once 'connectvars.php';

require_once 'sessionstart.php';

require_once 'model/article.php';
require_once 'model/article_mapper.php';
require_once 'view/articleView.php';
require_once 'login/logincontroller.php';
require_once 'login/loginmodel.php';

if(isset($_POST['login'])) {
	$loginController = new LoginController($_POST['username'], $_POST['password']);
	$loginController->login_submit();
}

global $prev;
global $next;
global $page;

$mainView = new ArticleView();
$page = 1;
if(isset($_GET['page'])) {
	$page = $_GET['page'];
}
$mainView->set_articles();

require_once 'design/start.php';
require_once 'design/nav.php';
require_once 'design/header.php';

$mainView->print_articles();

require_once 'design/pagenav.php';
require_once 'design/footer.php';
require_once 'design/end.php';

?>