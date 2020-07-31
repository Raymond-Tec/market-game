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
            <input type="text" id="username" class="form-control" name="username" value="<?php $_GET['username']; ?>" required autofocus>
            <label for="email">Email:</label><br>
            <input type="email" id="email" class="form-control" name="email" value="<?php $_GET['email']; ?>"  required>
            <label for="text">Nickname:</label><br>
            <input type="text" id="nickname" class="form-control" name="nickname" value="<?php $_GET['nickname']; ?>"  required>
            <p class="text-danger">Make this different than your username to protect your account.</p>
        </div>
        <div class="col">
            <label for="password1">Enter A Password:</label><br>
            <input type="password" id="password1" class="form-control" name="password1" required>
            <label for="password2">Confirm Your Password:</label><br>
            <input type="password" id="password2" class="form-control" name="password2" required>
            <div class="pt-3"><input type="submit" class="btn btn-primary" value="Register"></div>
            </form>
        </div>
    </div>
</div>