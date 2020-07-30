<div class="container-fluid">
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
</div>