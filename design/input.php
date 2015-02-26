<div class="content">
	<?php if(isset($error) && !empty($error)) echo '<p>' . $error . '</p>'; ?>
	<form method="post" action="inputpost.php">
		<label for="title">Title:</label><br>
		<input type="text" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>"><br>
		<label for="content">Content:</label><br>
		<textarea id="content" name="content" rows="40" cols="85"><?php if(isset($_POST['content'])) echo $_POST['content']; ?></textarea><br>
		<input type="submit" name="submit" value="submit">
	</form>
</div>