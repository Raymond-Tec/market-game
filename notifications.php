<?php if (isset($_GET['msg']) || isset($_POST['message'])){?>
<div class="container bg-light">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center p-2">
        <?php
            if ($_GET['msg']=="badlogin") {
                echo "<span class=\"alert-danger\">Incorrect Username or Password.</span>";
            } elseif ($_GET['msg']=="logoutsuccess") {
                echo "<span class=\"alert-success\">You have successfully logged out.</span>";
            } elseif ($_GET['msg']=="loginsuccess") {
                echo "<span class=\"alert-success well-sm\">You have successfully logged in, ".$_SESSION['nickname'].".";
            } elseif ($_GET['msg']=="badregpw") {
                echo "<span class=\"alert-danger\">Passwords don't match.</span>";
            } elseif ($_GET['msg']=="badregun") {
                echo "<span class=\"alert-danger\">Username already exists, please select another</span>";
            }
        ?>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<?php } ?>