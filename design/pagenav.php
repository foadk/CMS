
<div class="content" id="pagenav">
<?php
if($prev) {
	$page_link = $page - 1; 
	echo '<a id="previous" href="?page=' . $page_link . '">Previous page</a>';
} 
if($next) {
	$page_link = $page + 1;
	echo '<a id="next" href="?page=' . $page_link . '">Next Page</a>';
}
?>
</div>