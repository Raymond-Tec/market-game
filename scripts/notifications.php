<?php if (isset($_GET['msg']) || isset($_POST['message'])){?>
<div class="container bg-light">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center well-sm p-2">
        <?php
            if ($_GET['msg']=="badlogin") {
                echo "<span class=\"alert-danger\">Incorrect Username or Password.</span>";
            } elseif ($_GET['msg']=="logoutsuccess") {
                echo "<span class=\"alert-success\">You have successfully logged out.</span>";
            } elseif ($_GET['msg']=="loginsuccess") {
                echo "<span class=\"alert-success\">You have successfully logged in, ".$_SESSION['nickname'].".";
            } elseif ($_GET['msg']=="badregpw") {
                echo "<span class=\"alert-danger\">Passwords don't match.</span>";
            } elseif ($_GET['msg']=="badregun") {
                echo "<span class=\"alert-danger\">Username already exists, please select another</span>";
            } elseif ($_GET['msg']=="badregpwsec") {
                echo "<span class=\"alert-danger\">Passwords must be at least 8 characters, contain at least one letter, one number, and one special character. Please try again.</span>";
            } elseif ($_GET['msg']=="goodreg") {
                echo "<span class=\"alert-success\">Registration successful. You may now login.";
            }
        ?>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<?php } ?>