<?php
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
        session_start();
        $_SESSION["username"] = $_POST['username'];
        echo $_SESSION["username"]." is now logged in.";
        echo "Redirect in 2 seconds.";
        header('Refresh: 2; url=index.php');
        exit();
    } else {
        echo "Username or password is incorrect.<br><br>"; //If the password is incorrect.
        header('Location: index.php?loc=loginform');
        exit();
    }
} else {
    echo "Username or password is incorrect.<br><br>"; //If the username doesn't exist.
    header('Location: index.php?loc=loginform');
    exit();
}

$conn=null; //Close connection to database

//print $result->name;

/*$options = [
    'cost' => 13,
];

$hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);*/
?>