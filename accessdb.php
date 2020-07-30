<?php
require 'dbcreds.php'; //Grab the database credentials
try {
    $conn = new PDO("$dbtype:host=$servername;dbname=$dbname", $username, $password);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "DB Connection Established.\n\n"
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br><br>"; //Error handling
}
?>