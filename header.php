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
    if ($_GET['msg']=='badlogin'){
    echo "<div class=\"row\">";
        echo "<div class=\"col-5\"></div>";
        echo "<div class=\"col-2 well-sm bg-warning text-center\">";
            echo "Bad Username or Password. Please Try Again.";
        echo "</div>";
        echo "<div class=\"col-5\"></div>";
    echo "</div>";
    }
    ?>
</div>