<?php
session_start();
$_SESSION['username'] = $_GET['username'];
$_SESSION['userid'] = $_GET['id'];
echo "go fuck yourself";
header('refresh: 2; Location: index.php');
exit();
?>