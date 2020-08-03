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

$conn=accessdb();

//Display table of what's going to be output by this script
for ($x=0; $x <= 1057; $x++) {
    $photo = $x + 1;
    $botfirstname = $femaleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botphoto = 'femprof_(' . $photo . ').jpg';
    
    try {
        $insertBot = $conn->prepare('INSERT INTO botplayer (botid, botfirstname, botlastname, botphoto) VALUES (:bid, :bfn, :bln, :bp)');
        echo "Inserting: ".$insertBot."...";
        $insertBot->execute(['bid'=>$x,'bfn'=>$botfirstname,'bln'=>$botlastname,'bp'=>$botphoto]);
        echo "Successful.<br>";
    } catch(PDOException $e) {
        echo $insertBot . "<br>" . $e->getMessage();
    }
}

for ($x=0; $x <= 983; $x++) {
    $photo = $x + 1;
    $botfirstname = $maleFN[rand(0,4638)];
    $botlastname = $surnames[rand(0,2000)];
    $botmoney = 10000.00;
    $botphoto = 'maleprof_(' . $photo . ').jpg';

    try {
        $insertBot = $conn->prepare('INSERT INTO botplayer (botid, botfirstname, botlastname, botphoto) VALUES (:bid, :bfn, :bln, :bp)');
        echo "Inserting: ".$insertBot."...";
        $insertBot->execute(['bid'=>$x,'bfn'=>$botfirstname,'bln'=>$botlastname,'bp'=>$botphoto]);
        echo "Successful.<br>";
    } catch(PDOException $e) {
        echo $insertBot . "<br>" . $e->getMessage();
    }
}