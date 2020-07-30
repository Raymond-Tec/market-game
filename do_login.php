<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1>Started</h1>
        <?php
        $conn = accessdb(); //open the connection to the database
        echo "<h2>DB Connection Open</h2>";

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
        <script src="" async defer></script>
    </body>
</html>
