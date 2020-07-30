<?php
session_start();
$conn = accessdb(); //open the connection to the database

try {
    $stmt = $conn->prepare("SELECT userid, username, password, email, nickname FROM user WHERE username = ?"); //Query the user table
    $stmt->execute([$_POST['username']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the single result
} catch(PDOException $e) {
    echo "Error: ".$e->getMessage(); //Error handling and display
}

if ($result){
    if (password_verify($_POST['password'], $result['password'])) { 
        //Create session variables.
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userid'] = $result['userid'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['nickname'] = $result['nickname'];
        $_SESSION['last_activity'] = time();
        header('Location: index.php');
        exit();
    } else {
        //Remove all session variables, destroy the session, close the database connection
        session_unset();
        session_destroy();
        header('Location: index.php?loc=loginform&msg=badlogin');
        exit();
    }
} else {
    //Remove all session variables and destroy the session
    session_unset();
    session_destroy();
    header('Location: index.php?loc=loginform&msg=badlogin');
    exit();
}

$conn=null; //Close connection to database, the script shouldn't get here but just in case.
?>