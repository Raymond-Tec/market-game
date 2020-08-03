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

//Display table of what's going to be output by this script
?>
<table>
    <thead>
    <tr>
        <td>
            ID
        </td>
        <td>
            First Name
        </td>
        <td>
            Last Name
        </td>
        <td>
            Profile Photo
        </td>
        <td>
            Money
        </td>
    </tr>
    </thead>
    <tbody>
        <?php
        for ($x=0; $x <= 1057; $x++) {
            echo "<td>";
                echo $femaleFN[rand(0,4638)];
            echo "</td>";
            echo "<td>";
                echo $surnames[rand(0,2000)];
            echo "</td>";
            echo "<td>";
                echo "femprof_(" . $x+1 . ")";
            echo "</td>";
        } ?>
    </tbody>
</table>