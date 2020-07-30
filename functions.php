<?php
function accessdb() {
    require 'dbcreds.php'; //Grab the database credentials
    try {
        $conn = new PDO($dsn, $dbun, $dbpw, $options);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br><br>"; //Error handling
    }
    return $conn;
}

/*Returns the first $wordsreturned out of $string. If string contains fewer words than $wordsreturned, the entire string 
is returned. newsID and newstitle added by RT to create More link.*/
function shorten_newsString($string, $wordsreturned, $newsid, $newstitle) {
    $retval = $string;      //  Just in case of a problem
    $array = explode(" ", $string); //Takes the string and explodes it into an array using the <space> as a separator

    if (count($array)<=$wordsreturned) {  //  Already short enough, return the whole thing
        $retval = $string;
    } else { // It's not short enough chop off words after wordsreturned.
        array_splice($array, $wordsreturned); //Cuts the array off after wordsreturned
        $retval = implode(" ", $array)." ... <a href=\"index.php?loc=news&newsid=".$newsid."\" title=\"".$newstitle."\">More</a>"; //Creates the return string with More link
    }
        return $retval;
}

function ret_nick($nickID) {
    $conn = accessdb();
    $nickname = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
    $nickname->execute([$nickID]); //Execute the SQL statement
    $nickResult = $nickname->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
    $retval = $nickResult['nickname'];
    $conn=null;
    return $retval;
}
?>