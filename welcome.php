<h1>Welcome to the Market Game</h1>
<h4>v.<?php echo $ver; ?></h4>

<?php
if ($_SESSION['username'] == null) {
    echo "Please login to play.";
} else {
    echo "Welcome, ".$_SESSION['username'];
}
echo $_SESSION['username'];
?>