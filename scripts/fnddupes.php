<?php
require 'functions.php';

$conn=accessdb();

$dupes = $conn->prepare('SELECT businessname, COUNT(businessname) FROM businesses GROUP BY businessname HAVING COUNT(businessname)>1')->fetchAll(PDO::FETCH_ASSOC);
echo $dupes[0][bussinessname];
?>