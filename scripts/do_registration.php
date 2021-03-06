<?php
require 'functions.php';

$newUsername = $_POST['username'];
$newEmail = $_POST['email'];
$newNickname = $_POST['nickname'];
$newPW1 = $_POST['password1'];
$newPW2 = $_POST['password2'];

//Check to make sure passwords match, if they don't send the user back to the registration page.
if ($newPW1 !== $newPW2) {
    $url="Location: ../index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregpw";
    $conn=null;
    header($url);
    exit();
}
//Check to make sure passwords are at least 8 characters have at least 1 letter, 1 number, and 1 special character.
if (strlen($newPW1)<8 || !preg_match("#[0-9]+#",$newPW1) || !preg_match("#[a-zA-Z]+#",$newPW1) || !preg_match("@[^\w]@",$newPW1)) {
    $url="Location: ../index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregpwsec";
    $conn=null;
    header($url);
    exit();
} 
//Open DB and pull all usernames and emails out of user DB to verify the new username is available.
$conn = accessdb();

$users = $conn->query('SELECT username, email FROM user');
while ($userResult = $users->fetch()) {
    if ($newUsername == $userResult['username']) {
        $url="Location: ../index.php?loc=registration&username=".$newUsername."&email=".$newEmail."&nickname=".$newNickname."&msg=badregun";
        $conn=null;
        header($url);
        exit();
    }
    if ($newEmail == $userResult['email']) {
        $url="Location: ../index.php?loc=forgotpw&msg=badregem";
        $conn=null;
        header($url);
        exit();
    }
}
//Password meets criteria. Username is unique. Now, hash the password.
$options = [ 'cost' => 13, ];
$hashedpw = password_hash($newPW1, PASSWORD_BCRYPT, $options);

//Finally, do the user record insert.
try {
    $insertUser = $conn->prepare('INSERT INTO user (username, password, usergroup, email, nickname, usercreated, userlastlogin) VALUES (:username,:password,127,:email,:nickname,:usercreated,:userlastlogin)');
    $insertUser->execute(['username' => $newUsername, 'password' => $hashedpw, 'email'=>strtolower($newEmail), 'nickname'=>$newNickname, 'usercreated'=>date('Y-m-d H:i:s'),'userlastlogin'=>date('Y-m-d H:i:s')]);
    $url="Location: ../index.php?loc=loginform&msg=goodreg";
    $conn=null;
    header($url);
    exit();
} catch(PDOException $e) {
    echo $insertURL . "<br>" . $e->getMessage();
    $conn=null;
    exit();
}
?>