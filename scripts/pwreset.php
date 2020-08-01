<div class="container bg-light">
    <div class="row">
        <div class="col">
            <h4>Forgot Password</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="scripts/do_fpw.php?fpw=<?php echo $_GET['fpw']; ?>" class="needs-validation" id="fpwform" method="post" autocomplete="on">
            <p class="text-danger">Make sure passwords are at least 8 characters and contain at least 1 number, 1 letter, and 1 special character.</p>
            <label for="password1">Enter A Password:</label><br>
            <input type="password" id="password1" class="form-control" name="password1" required>
            <label for="password2">Confirm Your Password:</label><br>
            <input type="password" id="password2" class="form-control" name="password2" required>            
            <div class="pt-3"><input type="submit" class="btn btn-primary" value="Update Password"></div>
            </form>
        </div>
    </div>
</div>