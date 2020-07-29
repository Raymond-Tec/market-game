<?php
session_start();
require 'accessdb.php'; //open the connection to the database

try {
$stmt = $conn->prepare("SELECT userid, username, password, email FROM user WHERE username = ?"); //Query the user table
$stmt->execute([$_POST['username']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the single result
}

catch(PDOException $e) {
    echo "Error: ".$e->getMessage(); //Error handling and display
}

if ($result){ // If the username exists, check the password
    if (password_verify($_POST['password'], $result['password'])) { 
        //Start a session
        $un = $_POST['username'];
        $id = $result['userid'];
        $_SESSION['username'] = $_GET['username'];
        $_SESSION['userid'] = $_GET['id'];
        header('Location: index.php');
        exit();
    } else {
        //Remove all session variables
        session_unset();
        //Destroy the session
        session_destroy();
        header('Location: index.php?loc=loginform&msg=badlogin');
        exit();
    }
} else {
    //Remove all session variables
    session_unset();
    //Destroy the session
    session_destroy();
    header('Location: index.php?loc=loginform&msg=badlogin');
    exit();
}

$conn=null; //Close connection to database

//print $result->name;

/*$options = [
    'cost' => 13,
];

$hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);*/
?>