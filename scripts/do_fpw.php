<?php
session_start();
require 'mgstats.php';
require 'functions.php';
$conn = accessdb(); //open the connection to the database

//Determine if this file is being called to search for and send the email or reset the password.
if ($_POST['email']) {
    //Find email address in database
    try {
        $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?"); //Query the user table
        $stmt->execute([strtolower($_POST['email'])]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the single result
    } catch(PDOException $e) {
        echo "Error: ".$e->getMessage(); //Error handling and display
    }

    //If the email address exists
    if ($result){
        $tokenTime = time(); //Get the current Unix timestamp
        $token = sha1($tokenTime.$result['email']); //Build the token
        $url = "https://raymondtec.com/market-game/index.php?loc=pwreset&fpw=".$token; //Build the URL for the email from token
        $sub = $gameName." Password Reset";
        $msg = $result['nickname'].",\nSomeone, possibly you, attempted to reset your password for your account. If it was you, please <a href=\"".$url."\" title=\"Password Reset\">click this link</a> within 30 minutes.\nIf it wasn't you, you may disregard this email.";
        $resetemail = sendMail($result['email'],$sub,$msg); //Send the email

        //Put the token and the token expiry into the database
        try {
            $setToken = $conn->prepare('UPDATE user SET token=?, tokenexpiry=? WHERE email=?');
            $setToken->execute([$token,$tokenTime,$result('email')]);
        } catch(PDOException $e) {
            echo $sql."<br>".$e->getMessage();
        }
        $conn = null; //Close database connection
        header('Location: ../index.php?msg=pwreset');
        exit();

    } else {
        //Send email stating that email address wasn't found.
        $sub = $gameName." Password Reset";
        $msg = "Someone, possibly you, attempted to reset a password using this email address. Unfortunately, there is no user account associated with this address.\n Please try a different address.";
        $resetemail = sendMail(strtolower($_POST['email']),$sub,$msg);
        $conn=null; //Close database connection
        header('url=../index.php?msg=pwreset');
        exit();
    }
} elseif ($_GET['fpw']) {
    //Verify the token hasn't expired and update the record
    //Find email address in database and pull the token and token expiry
    try {
        $stmt = $conn->prepare("SELECT email, token, tokenexpiry FROM user WHERE token = ?"); //Query the user table
        $stmt->execute([$_GET['fpw']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the single result
    } catch(PDOException $e) {
        echo "Error: ".$e->getMessage(); //Error handling and display
    }
    //Check to make sure that the token is legit. If not, return to the home page.
    if ($result) {
        echo "Found token in the DB.\n";
        //Verify that the token hasn't expired.
        if ($result['tokenexpiry']+1800<=time()) {
            //Check to make sure the passwords match and are secure.
            $newPW1 = $_POST['password1'];
            $newPW2 = $_POST['password2'];

            //Check to make sure passwords match, if they don't send the user back to the registration page.
            if ($newPW1 !== $newPW2) {
                $conn=null;
                $url="Location: ../index.php?loc=pwreset&fpw=".$_GET['fpw']."&msg=badregpw";
                header($url);
                exit();
            }

            //Check to make sure passwords are at least 8 characters have at least 1 letter, 1 number, and 1 special character.
            if (strlen($newPW1)<8 || !preg_match("#[0-9]+#",$newPW1) || !preg_match("#[a-zA-Z]+#",$newPW1) || !preg_match("@[^\w]@",$newPW1)) {
                $conn=null;
                $url="Location: ../index.php?loc=pwreset&fpw=".$_GET['fpw']."&msg=badregpwsec";
                header($url);
                exit();
            } 

            //Update the password in the DB
            try {
                $setToken = $conn->prepare('UPDATE user SET password=? WHERE email=?');
                $setToken->execute([$newPW1,$result('email')]);
            } catch(PDOException $e) {
                echo $sql."<br>".$e->getMessage();
            }
            //Send user to login form with success message
            $conn = null;
            header('url=../index.php?loc=loginform&msg=newpw');
            exit();
        } else {
            //If the token has expired, send the user to the forgot password page to try again
            $conn = null;
            header('url=../index.php?loc=forgotpw&msg=pwtokenexpired');
            exit();
        }
    } else {
        //If the token isn't legit and they somehow got here, it sends them back to the home page.
        $conn = null;
        header('url=../index.php');
        exit();
    }
} else {
    //Arrive here if email and fpw aren't set by post.
    $conn = null;
    header('Location: ../index.php');
    exit();
}
?>