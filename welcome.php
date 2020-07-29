<h1>Welcome to the Market Game</h1>
<h4>v.<?php echo $ver; ?></h4>

<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    echo "Please login to play.";
} else {
    echo "Welcome, ".$_SESSION['username'];
}
?>