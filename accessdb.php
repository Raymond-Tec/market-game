<?php
$severname = "10.132.86.110";
$username = "marketgame";
$password = "VDdq!r1uAgF!1R2at8";

try {
    $conn = new PDO("mysql:host=$severname;dbname=marketgame", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
    $conn = null;
    echo "Connection Closed";
} catch(PDOException $e) {
    echo "Connection failed:" . $e->getMessage();
}
?>