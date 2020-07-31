<?php if (isset($_GET['msg']) || isset($_POST['message'])){?>
<div class="container bg-light">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 text-center">
        <?php
            if ($_GET['msg']=="badlogin") {
                echo "<span class=\"alert-danger well-sm\">Incorrect Username or Password.</span>";
            } elseif ($_GET['msg']=="logoutsuccess") {
                echo "<span class=\"alert-success well-sm\">You have successfully logged out.</span>";
            } elseif ($_GET['msg']=="loginsuccess") {
                echo "<span class=\"alert-success well-sm\">You have successfully logged in, ".$_SESSION['nickname'].".";
            }
        ?>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<?php } ?>