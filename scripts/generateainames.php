<?php
require 'functions.php';
require 'mgstats.php';

$femaleFN = explode(PHP_EOL,file_get_contents('popular-girls-names.csv'));
echo $femaleFN[0];

?>