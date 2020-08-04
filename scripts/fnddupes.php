<?php
require 'functions.php';

$conn=accessdb();

try {
    $dupes = $conn->prepare('SELECT businessname, COUNT(businessname) FROM businesses GROUP BY businessname HAVING COUNT(businessname)>1')->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    echo $e->getMessage();
}
echo $dupes[0];
?>