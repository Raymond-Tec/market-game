<?php
require 'functions.php';
require 'mgstats.php';
$conn = accessdb();

$totalRows = $conn->query('SELECT count(*) FROM geodata')->fetchColumn();

echo $totalRows." rows in geodata table.";

//$geo = $conn->query('SELECT city, state_id, id FROM geodata')->fetchAll(PDO::FETCH_ASSOC);

?>