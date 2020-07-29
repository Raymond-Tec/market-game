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
        <?php
        require 'accessdb.php';

        try {
        $stmt = $conn->prepare("SELECT id, username, password, email FROM user WHERE username=".$_POST['username'])
        $stmt->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ);
        }
        catch(PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
        $conn=null;
        print $result->name;

        /*$options = [
            'cost' => 13,
        ];

        $hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);*/

        ?>        
        <script src="" async defer></script>
    </body>
</html>