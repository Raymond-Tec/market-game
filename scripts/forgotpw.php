<div class="container bg-light">
    <div class="row">
        <div class="col">
            <h4>Forgot Password</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <form action="scripts/do_fpw.php" class="needs-validation" id="fpwform" method="post" autocomplete="off">
                <label for="email">Email Address:</label><br>
                <input type="text" id="email" class="form-control" name="email" required autofocus><br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col text-center">
            <div class="well-sm">
                <span class="text-danger">Your IP address (<?php echo $_SERVER['REMOTE_ADDR']; ?>) and User Agent (<?php echo $_SERVER['HTTP_USER_AGENT']; ?>) will be sent to the recipient of this email.</span>
            </div>
        </div>
    </div>
</div>
<?php logevent('Accessed Forgot PW Form'); ?>