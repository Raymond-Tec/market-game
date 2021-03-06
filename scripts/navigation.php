<!-- this needs to be converted to Toast notifications -->
<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION['username'])) {?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardropgame" data-toggle="dropdown">Game</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?loc=companyview" alt="View Companies">Companies</a>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Site</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="index.php?loc=news" alt="News">News</a>
                    <?php
                    if (isset($_SESSION['username'])) {
                        if ($_SESSION['usergroup']==0) {
                            echo "<a class=\"dropdown-item\" href=\"index.php?loc=admin\" alt=\"Admin\">Admin</a>";
                        } 
                        echo "<a class=\"dropdown-item\" href=\"index.php?loc=account\" alt=\"Account\">Account</a>";
                        echo "<a class=\"dropdown-item\" href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a>";
                    } else {
                        echo "<a class=\"dropdown-item\" href=\"index.php?loc=registration\" alt=\"Register\">Register</a>";
                        echo "<a class=\"dropdown-item\" href=\"index.php?loc=loginform\" alt=\"Login\">Login</a>";
                    }?>
                </div>
            </li>
        </ul>
    </div>
</nav>