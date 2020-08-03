<?php
session_start();
require 'functions.php';
require 'mgstats.php';

//Import female first names into an array
$femaleFN = explode(PHP_EOL,file_get_contents('popular-girls-names.csv'));

//Import male first names into an array
$maleFN = explode(PHP_EOL,file_get_contents('popular-boys-names.csv'));

//Import surnames into an array
$surnames = explode(PHP_EOL,file_get_contents('surnames.csv'));

echo "Female First Names: ".count($femaleFN)."<br>";
echo "Male First Names: ".count($maleFN)."<br>";
echo "Surnames: ".count($surnames)."<br>";

//Build Female fore and sur names into an array
for ($x=0; $x <= 1058; $x++) {
    $combinedFemale[$x] = $surnames[rand(0,2001)].", ".$femaleFN[rand(0,4639)];
    echo $combinedFemale[$x]."<br>";
}

?>