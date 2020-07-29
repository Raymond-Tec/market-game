<font size="24px" align="left">The Market Game</font> 
<font align="right">
<?php
if (session_status() == PHP_SESSION_NONE) {
    echo "<a href=\"index.php?loc=loginform\" alt=\"Login\">Login</a><br>";
} else {
    echo "<a href=\"index.php?loc=logout\" alt=\"Logout\">Logout</a><br>";
}
?>
</font>