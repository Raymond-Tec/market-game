<?php
if ($_GET['msg']){
    echo "<h3>Bad Username or Password. Please Try Again.</h3>";
}
?>
<form action="do_login.php" id="loginform" method="post" autocomplete="on">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required autofocus><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Login">
</form>