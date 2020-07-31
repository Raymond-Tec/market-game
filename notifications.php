<?php if (isset($_GET['msg']) || isset($_POST['message'])){?>
<div class="container row bg-light">
    <div class="col-3"></div>
    <div class="col-6 well-sm text-center">
    <?php
        if ($_GET['msg']=="badlogin") {
            echo "<span class=\"alert-danger\">Incorrect Username or Password.</span>";
        } elseif ($_GET['msg']=="logoutsuccess") {
            echo "<span class=\"alert-success\">You have successfully logged out.</span>";
        } elseif ($_GET['msg']=="loginsuccess") {
            echo "<span class=\"alert-success\">You have successfully logged in, ".$_SESSION['nickname'].".";
        }
    ?>
    </div>
    <div class="col-3"></div>
</div>
<?php } ?>