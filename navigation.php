<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <a class="navbar-nav" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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