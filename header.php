<div class="container bg-light rounded-top">
    <div class="row">
        <div class="col-9">
            <h1><a href="index.php" alt="<?php echo $gameName?>"><?php echo $gameName; ?></a></h1> 
        </div>
        <div class="col text-center">
            <a href="index.php?loc=news" alt="News">News</a> | 
            <?php
            if (isset($_SESSION['username'])) {
                if ($_SESSION['usergroup']==0) {
                    echo "<a href=\"index.php?loc=admin\" alt=\"Admin\">Admin</a> | ";
                }
                echo "<a href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a>";
            } else {
                echo "<a href=\"index.php?loc=loginform\" alt=\"Login\">Login</a>";
            }
            ?>
        </div>
    </div>
    <?php include 'notifications.php' ?>
</div>