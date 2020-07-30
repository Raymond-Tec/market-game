<?php
session_start();
$conn = accessdb(); //open the connection to the database
echo "Database Connected.<br>";
try {
$stmt = $conn->prepare("SELECT userid, username, password, email, nickname FROM user WHERE username = ?"); //Query the user table
echo "Initial statement prepared.<br>";
$stmt->execute([$_POST['username']]);
echo "Statement executed.<br>";
$result = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the single result
echo "Statement loaded into an array.";
}

catch(PDOException $e) {
    echo "Error: ".$e->getMessage(); //Error handling and display
}

if ($result){ // If the username exists, check the password
    if (password_verify($_POST['password'], $result['password'])) { 
        //Create session variables.
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userid'] = $result['userid'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['nickname'] = $result['nickname'];
        $_SESSION['last_activity'] = time();
        //Update the User table with the current date and time to reflect last login.
        /*try {
            echo "Trying to build the statement.<br><br>";
            $lastLogin = $conn->prepare('UPDATE user SET userlastlogin=? WHERE username=?');
            echo "Statement Prepared.<br><br>";
            $lastLogin->execute([date('Y-m-d H:i:s'),$_POST['username']]);
            echo "Record updated successfully.<br><br>";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }*/
        //Close the database connection
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