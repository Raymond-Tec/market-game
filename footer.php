<div class="container page-header">
    <div class="row">
        <div class="col text-center">
            <h1><a href="index.php" alt="<?php echo $gameName?>"><?php echo $gameName; ?></a></h1> 
        </div>
    </div>
    <div class="row">
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
    <div class="row">
        <div class="col text-center">
            &copy; 2020 Raymond Tec
        </div>
    </div>
</div>