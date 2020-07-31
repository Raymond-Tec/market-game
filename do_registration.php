<?php
require 'functions.php';

$newUsername = $_POST['username'];
$newEmail = $_POST['email'];
$newNickname = $_POST['nickname'];
$newPW1 = $_POST['password1'];
$newPW2 = $_POST['password2'];

//Check to make sure passwords match, if they don't send the user back to the registration page.
if ($newPW1 !== $newPW2) {
    $url="Location: index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregpw";
    header($url);
    exit();
}
//Check to make sure passwords are at least 8 characters have at least 1 letter, 1 number, and 1 special character.
if (strlen($newPW1)<8 || !preg_match("#[0-9]+#",$newPW1) || !preg_match("#[a-zA-Z]+#",$newPW1) || !preg_match("@[^\w]@",$newPW1)) {
    $url="Location: index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregpwsec";
    header($url);
    exit();
} 
echo "Password is good.";
//if ($_POST['username'])
?>