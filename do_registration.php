<?php
require 'functions.php';

$newUsername = $_POST['username'];
$newEmail = $_POST['email'];
$newNickname = $_POST['nickname'];
$newPW1 = $_POST['password1'];
$newPW2 = $_POST['password2'];

//Check to make sure passwords match, if they don't send the user back to the registration page.
if ($newPW1 !== $newPW2) {
    echo "Bad Passwords.";
    $url="Location: index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregpw";
    header($url);
}

//if ($_POST['username'])
?>