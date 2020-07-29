<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Market Game - Logging In</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h2>Logging you in.</h2>
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
                header('Location: index.php');
            } else {
                echo "Username or password is incorrect.<br><br>"; //If the password is incorrect.
                header('Location: index.php?loc=loginform');
            }
        } else {
            echo "Username or password is incorrect.<br><br>"; //If the username doesn't exist.
            header('Location: index.php?loc=loginform');
        }

        $conn=null; //Close connection to database

        //print $result->name;

        /*$options = [
            'cost' => 13,
        ];

        $hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);*/
        ?>
        <script src="" async defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" async></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" async></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" async></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" async>
    </body>
</html>