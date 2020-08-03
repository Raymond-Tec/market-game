<?php
session_start();
require 'functions.php';
require 'mgstats.php';

echo "Opening database...";
$conn=accessdb();
echo "Successful.<br>";

//Grab NAICS codes from database
$naics = $conn->prepare('SELECT naics_id FROM naics');
$naicsResult = $naics->execute();
echo "Number of NAICS Codes in database: ".count($naicsResult)."<br>";

//Grab geographic locations with more than 20,000 in population
$geo = $conn->prepare('SELECT id, `population` FROM geodata WHERE `population` >= 20000');
$geoResults = $geo->execute();
echo "Locations with more than 20,000: ".count($geoResults)."<br>";

/*
//Import female first names into an array (4639)
$femaleFN = explode(PHP_EOL,file_get_contents('popular-girls-names.csv'));

//Import male first names into an array (4629)
$maleFN = explode(PHP_EOL,file_get_contents('popular-boys-names.csv'));

//Import surnames into an array (2001)
$surnames = explode(PHP_EOL,file_get_contents('surnames.csv'));

echo "Available Female First Names: ".count($femaleFN)."<br>";
echo "Available Male First Names: ".count($maleFN)."<br>";
echo "Available Surnames: ".count($surnames)."<br>";

//Display table of what's going to be output by this script
for ($x=0; $x < 1058; $x++) {
    $photo = $x + 1;
    $botfirstname = $femaleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botphoto = 'femprof_(' . $photo . ').jpg';
    
    echo "Inserting: ".$x." ".$botfirstname." ".$botlastname." ".$botphoto."...";
    try {
        $insertBot = $conn->prepare('INSERT INTO botplayer (botfirstname, botlastname, botphoto) VALUES (:bfn, :bln, :bp)');
        $insertBot->execute(['bfn' => $botfirstname, 'bln' => $botlastname, 'bp' => $botphoto]);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "Successful.<br>";
}

for ($x=0; $x < 984; $x++) {
    $photo = $x + 1;
    $botfirstname = $maleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botmoney = 10000.00;
    $botphoto = 'maleprof_(' . $photo . ').jpg';

    echo "Inserting: ".$x." ".$botfirstname." ".$botlastname." ".$botphoto."...";
    try {
        $insertBot = $conn->prepare('INSERT INTO botplayer (botfirstname, botlastname, botphoto) VALUES (:bfn, :bln, :bp)');
        $insertBot->execute(['bfn' => $botfirstname, 'bln' => $botlastname, 'bp' => $botphoto]);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "Successful.<br>";
}*/
?>