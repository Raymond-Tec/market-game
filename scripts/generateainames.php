<?php
require 'functions.php';
require 'mgstats.php';

$femaleFN = explode("|",file_get_contents('popular-girls-names.csv'));
echo $femaleFN['1'];

?>