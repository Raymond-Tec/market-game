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
$totDupes = count($dupes);
echo $totDupes;
/*
for ($x=0; $x > $totDupes-1; $x++) {
    try {
        $findDupe = $conn->query('SELECT * FROM businesses WHERE businessname = \''.$dupes[0]['businessname'].'\'')->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    for ($y=1; $x > )
    try {
        $delDupe = $conn->query('DELETE FROM businesses WHERE businessid = \''.$findDupe[1]['businessid'].'\'')->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}*/
?>