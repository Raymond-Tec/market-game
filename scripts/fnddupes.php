<?php
require 'functions.php';

echo "Accessing Database...";
$conn=accessdb();
echo "Success.<br><br>";

try {
    $dupes = $conn->query('SELECT businessname, COUNT(businessname) FROM businesses GROUP BY businessname HAVING COUNT(businessname)>1')->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo $e->getMessage();
}
var_dump($dupes);
//echo $dupes[0][businessname]." ".$dupes[0][count];
?>