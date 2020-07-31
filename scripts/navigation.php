<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?loc=news" alt="News">News</a>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['username'])) {
                    if ($_SESSION['usergroup']==0) {
                        echo "<a class=\"nav-link\" href=\"index.php?loc=admin\" alt=\"Admin\">Admin</a>";
                    } ?>
            </li>
            <li class="nav-item">
                <?php
                    echo "<a class=\"nav-link\" href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a>"; ?>
            </li>
            <li class="nav-item">
                <?php
                    echo "<a class=\"nav-link\" href=\"index.php?loc=account\" alt=\"Account\">Account</a>"; ?>
            </li>
            <li class="nav-item">
                <?php
                } else {
                    echo "<a class=\"nav-link\" href=\"index.php?loc=registration\" alt=\"Register\">Register</a>";
                ?>
            </li>
            <li class="nav-item">
                <?php
                    echo "<a class=\"nav-link\" href=\"index.php?loc=loginform\" alt=\"Login\">Login</a>";
                }?>
            </li>
        </ul>
    </div>
</div>