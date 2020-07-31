<div class="container bg-light">
    <div class="row">
        <div class="col">
            <h4>Account Registration</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="do_registration.php" class="needs-validation" id="loginform" method="post" autocomplete="off">
            <label for="username">Username:</label><br>
            <input type="text" id="username" class="form-control" name="username" required autofocus>
            <label for="password1">Enter A Password:</label><br>
            <input type="password" id="password1" class="form-control" name="password1" required>
            <label for="password2">Confirm Your Password:</label><br>
            <input type="password" id="password2" class="form-control" name="password2" required>
        </div>
        <div class="col">
            <label for="email">Email:</label><br>
            <input type="email" id="email" class="form-control" name="email" required>
            <label for="text">Nickname:</label><br>
            <input type="text" id="nickname" class="form-control" name="nickname" required>
            <p class="text-danger well-sm">Make this different from your username to protect your account.</p>
            <input type="submit" class="btn btn-primary" value="Login">
            </form>
        </div>
    </div>
</div>