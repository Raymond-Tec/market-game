<div class="container-fluid page-header">
    <div class="row">
        <div class="col-10">
            <h1><?php echo $gameName; ?></h1> 
        </div>
        <div class="col">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<a href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a><br>";
            } else {
                echo "<a href=\"index.php?loc=loginform\" alt=\"Login\">Login</a><br>";
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_GET['msg']) || isset($_POST['message'])){?>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 well-sm alert-danger text-center">
        <?php
            if ($_GET['msg']=="badlogin") {
                echo "Incorrect Username or Password.";
            } elseif ($_GET['msg']=="logoutsuccess") {
                echo "You have successfully logged out.";
            }
        ?>
        </div>
        <div class="col-3"></div>
    </div>
    <?php } ?>
</div>