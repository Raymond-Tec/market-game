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
        $findDupe = $conn->prepare('SELECT * FROM businesses WHERE businessname = :bn');
        $findDupe->bindParam(':bn',$dupes[$x]['businessname']);
        $foundDupe->execute(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    for ($y=1; $y < $dupes[$x]['COUNT(businessname']; $y++) {
        try {
            $delDupe = $conn->query('DELETE FROM businesses WHERE businessid = \''.$findDupe[$y]['businessid'].'\'')->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>