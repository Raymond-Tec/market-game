<?php
require 'dbcreds.php'; //Grab the database credentials
try {
    $conn = new PDO($dsn, $dbun, $dbpw, $options);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "<br><br>"; //Error handling
}
?>