<?php
function shorten_newsString($string, $wordsreturned, $newsid, $newstitle)
/*  Returns the first $wordsreturned out of $string.  If string
contains fewer words than $wordsreturned, the entire string
is returned.
*/
{
$retval = $string;      //  Just in case of a problem
 
$array = explode(" ", $string);
if (count($array)<=$wordsreturned)
/*  Already short enough, return the whole thing
*/
{
$retval = $string;
}
else
/*  Need to chop of some words
*/
{
array_splice($array, $wordsreturned);
$retval = implode(" ", $array)."<a href=\"index.php?loc=news&newsid=".$newsid."\" title=\"".$newstitle."\">...More</a>";
}
return $retval;
}
?>