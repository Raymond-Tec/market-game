<?php
session_start();
$_SESSION['username'] = $_GET['username'];
$_SESSION['userid'] = $_GET['id'];
header('Location: index.php');
exit();
?>