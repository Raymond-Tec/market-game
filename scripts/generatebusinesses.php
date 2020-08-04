<?php
session_start();
require 'functions.php';
require 'mgstats.php';

echo "Opening database...";
$conn=accessdb();
echo "Successful.<br><br>";

//Grab NAICS codes from database
$naics = $conn->query('SELECT naics_id FROM naics')->fetchALL(PDO::FETCH_COLUMN);
echo "Number of NAICS Codes in database: ".count($naics)." Random Industry: ".$naics[rand(0,count($naics))]."<br><br>";

//Grab geographic locations with more than 5,000 in population
$geo = $conn->query('SELECT id, `population` FROM geodata WHERE `population` >= 5000')->fetchAll(PDO::FETCH_ASSOC);
echo "Locations with more than 5,000: ".count($geo)." Random Location: ".$geo[rand(0,count($geo))][id]."<br>";

//Import business names into an array and count total number of business names.
$busName = explode(PHP_EOL,file_get_contents('business-names.csv'));
$totalBus = count($busName);

echo "Total Business Names: ".$totalBus."<br>";

//There were quotes in the csv file. This gets rid of them.
for ($x=0; $x < $totalBus; $x++) {
    $busName[$x] = str_replace('"',"",$busName[$x]);
}
/*
//Display table of what's going to be output by this script
for ($x=0; $x < $totalBus; $x++) {
    $naicsRand = rand(0,count($naics));
    $geoRand = rand(0,count($geo));
    echo "Inserting: ".$x." of ".$totalBus.". Name: ".$busName[$x]."Industry ID: ".$naics[$naicsRand]." Geographic ID: ".$geo[$geoRand]."...";
    try {
        $insertBus = $conn->prepare('INSERT INTO businesses (businessname, industryid, location_id) VALUES (:bn, :iid, :lid)');
        $insertBot->execute(['bn' => $busName[$x], 'iid' => $naics[$naicsRand], 'lid' => $geo[$geoRand]]);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "Successful.<br>";
}
*/
?>