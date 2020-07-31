<div class="navbar-expand-xl">
    <div class="navbar text-right">
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