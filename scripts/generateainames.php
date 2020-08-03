<?php
session_start();
require 'functions.php';
require 'mgstats.php';

//Import female first names into an array (4639)
$femaleFN = explode(PHP_EOL,file_get_contents('popular-girls-names.csv'));

//Import male first names into an array (4629)
$maleFN = explode(PHP_EOL,file_get_contents('popular-boys-names.csv'));

//Import surnames into an array (2001)
$surnames = explode(PHP_EOL,file_get_contents('surnames.csv'));

echo "Available Female First Names: ".count($femaleFN)."<br>";
echo "Available Male First Names: ".count($maleFN)."<br>";
echo "Available Surnames: ".count($surnames)."<br>";

$conn = accessdb();

//Display table of what's going to be output by this script
for ($x=0; $x <= 1057; $x++) {
    $photo = $x + 1;
    $botfirstname = $femaleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botphoto = "femprof_(" . $photo . ").jpg";

    try {
        echo "Attempting to insert: ".$x." ".$botfirstname.$botlastname." ".$botphoto."<br>";
        $insertFemale = $conn->prepare('INSERT INTO botplayer (botid, botfirstname, botlastname, botphoto) VALUES (:botid, :botfirstname, :botlastname, :botphoto');
        echo "SQL Statement: ". $insertFemale;
        $insertFemale->execute(['botid' => $x, 'botfirstname' => $botfirstname, 'botlastname' => $botlastname, 'botphoto' => $botphoto]);
        echo "Successfully inserted: ".$x." ".$botfirstname.$botlastname." ".$botphoto."<br>";
    } catch(PDOException $e) {
        echo $insertFemale . "<br>" . $e->getMessage();
        $conn = null;
        exit();
    }
}

for ($x=0; $x <= 983; $x++) {
    $photo = $x + 1;
    $botfirstname = $maleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botmoney = 10000.00;
    $botphoto = "maleprof_(" . $photo . ").jpg";

    try {
        echo "Attempting to insert: ".$x." ".$botfirstname.$botlastname." ".$botphoto."<br>";
        $insertMale = $conn->prepare('INSERT INTO botplayer (botid, botfirstname, botlastname, botphoto) VALUES (:botid, :botfirstname, :botlastname, :botphoto');

        $insertMale->execute(['botid' => $x, 'botfirstname' => $botfirstname, 'botlastname' => $botlastname, 'botphoto' => $botphoto]);
        echo "Successfully inserted: ".$x." ".$botfirstname.$botlastname." ".$botphoto."<br>";
    } catch(PDOException $e) {
        echo $insertMale . "<br>" . $e->getMessage();
        $conn = null;
        exit();
    }
}