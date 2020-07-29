<font size="24px" align="left"><?php echo $gameName; ?></font> 
<font align="right">
<?php
if (isset($_SESSION['username'])) {
    echo "<a href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a><br>";
} else {
    echo "<a href=\"index.php?loc=loginform\" alt=\"Login\">Login</a><br>";
}
?>
</font>