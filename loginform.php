<?php
if ($_GET['msg']=='badlogin'){
    echo "<div class=\"bg-warning\">Bad Username or Password. Please Try Again.</div>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2>Login</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="do_login.php" id="loginform" method="post" autocomplete="on">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required autofocus>
        </div>
        <div class="col">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="submit" value="Login">
            </form>
        </div>
    </div>
</div>

