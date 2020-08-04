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
echo "Total Duplicates Found: ".$totDupes."<br><br>";

for ($x=0; $x < $totDupes-1; $x++) {
    try {
        $findDupe = $conn->prepare('SELECT * FROM businesses WHERE businessname = ?');
        $findDupe->execute([$dupes[$x]['businessname']]);
        $foundDupe = $findDupe->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "Deleting ".$foundDupe[0]['businessname']." with ID: ".$foundDupe[0]['businessid']."<br>";

/*
    for ($y=1; $y < $dupes[$x]['COUNT(businessname']; $y++) {
        echo "Deleting ".$foundDupe[$y]['businessname']." with ID: ".$foundDupe[$y]['businessid']."<br>";
        try {
            $delDupe = $conn->prepare('DELETE FROM businesses WHERE businessid = ?');
            $delDupe->execute([$foundDupe[$y]['businessid']]);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }*/
}
?>