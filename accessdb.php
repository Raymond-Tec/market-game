<?php
require 'dbcreds.php';
try {
    $conn = new PDO("mysql:host=$severname;dbname=marketgame", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
} catch(PDOException $e) {
    echo "Connection failed:" . $e->getMessage();
}
?>