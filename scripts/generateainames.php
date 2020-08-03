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

//Build Female fore and sur names into an array
/*for ($x=0; $x <= 1058; $x++) {

}*/

$sid = session_id();
echo "Session ID: ".$sid;

?>