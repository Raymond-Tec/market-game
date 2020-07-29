<?php
require 'dbcreds.php';
try {
    echo "Start Connection<br><br>";
    $conn = new PDO("$dbtype:host=$servername;dbname=$dbname", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully<br><br>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br><br>";
}
?>