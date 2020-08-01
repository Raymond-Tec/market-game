<div class="container bg-light">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h4>Login</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="scripts/do_login.php" class="needs-validation" id="loginform" method="post" autocomplete="on">
            <label for="username">Username:</label><br>
            <input type="text" id="username" class="form-control" name="username" required autofocus>
        </div>
        <div class="col">
            <label for="password">Password:</label><br>
            <input type="password" id="password" class="form-control" name="password" required><br>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="submit" class="btn btn-primary" value="Login">
            </form>
        </div>
        <div class="col-10"></div>
    </div>
    <div class="row">
        <div class="col text-center">
            <p>Forgot your password? <a href="index.php?loc=forgotpw" title="Forgot Password">Click here</a> to reset it.</p>
            <p>Don't have an account? <a href="index.php?loc=registration" title="Account Registration">Click here to register</a>.</p>
        </div>
    </div>
</div>

