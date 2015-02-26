<div class="nav">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="">Best New</a></li>
        <li><a href="">About Us</a></li>
        <?php

if(isset($_SESSION['user_id'])) {
        ?>
        <li id="logout"><a href="logout.php">Log out</a></li>
        <li><a href="inputpost.php">New Post</a></li>
        <?php
}
        ?>
    </ul>

    <?php
if(!isset($_SESSION['user_id'])) {
    ?>

    <div id="login">
        <a href="#" onclick="return false;">Login</a>
        <div>
            <form method="post" action="index.php">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" /><br />
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" /><br />
                <input type="submit" name="login" value="Login" />
            </form>
        </div>
    </div>
    <?php
}
    ?>
</div>