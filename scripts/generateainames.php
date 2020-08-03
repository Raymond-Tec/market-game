<?php
require 'functions.php';
require 'mgstats.php';

$femaleFN = file_get_contents('popular-girls-names.csv');
$femaleFNar = explode(' ',$femaleFN);
echo $femaleFNar['0'];

?>