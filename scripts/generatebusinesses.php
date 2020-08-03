<?php
session_start();
require 'functions.php';
require 'mgstats.php';

echo "Opening database...";
$conn=accessdb();
echo "Successful.<br>";

//Grab NAICS codes from database
$naics = $conn->query('SELECT naics_id FROM naics')->fetchAll(PDO::FETCH_NUM);
echo "Number of NAICS Codes in database: ".count($naics)."<br>";

//Grab geographic locations with more than 5,000 in population
$geo = $conn->query('SELECT id, `population` FROM geodata WHERE `population` >= 5000')->fetchAll(PDO::FETCH_NUM);
echo "Locations with more than 5,000: ".count($geo)."<br>";


//Import business names into an array and count total number of business names.
$busName = explode(PHP_EOL,file_get_contents('business-names.csv'));
$totalBus = count($busName);

echo "Total Business Names: ".$totalBus."<br>";

for ($x=0; $x < $totalBus; $x++) {
    echo $busName[$x]."<br>";
}

/*
//Display table of what's going to be output by this script
for ($x=0; $x < $totalBus; $x++) {
    echo "Inserting: ".$x." of ".$totalBus.". Name: ".$busName[$x]."...";
    try {
        $insertBus = $conn->prepare('INSERT INTO businesses (businessname, industryid, location_id) VALUES (:bn, :iid, :lid)');
        $insertBot->execute(['bn' => $busName[$x], 'iid' => $naics[rand(0,count($naics))], 'lid' => $geo[rand(0,count($geo))]]);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "Successful.<br>";
}
*/
?>