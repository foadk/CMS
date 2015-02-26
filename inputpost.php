<?php
require_once 'connectvars.php';

require_once 'sessionstart.php';
require_once 'Authenticate.php';

require_once 'model/article.php';
require_once 'model/article_mapper.php';
require_once 'view/articleView.php';
require_once 'controller/articlecontroller.php';
require_once 'model/ArticleHandler.php';

if(isset($_POST['submit'])) {
	$result = (new ArticleController())->get_input();
	if($result) {
		(new ArticleView())->after_submit();
	} else {
		$error = "Please enter title and post content.";
	}
}
require_once 'design/start.php';
require_once 'design/nav.php';
require_once 'design/header.php';

require_once 'design/input.php';

require_once 'design/footer.php';
require_once 'design/header.php';
?>