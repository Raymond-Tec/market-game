<h2>News</h2>
<?php
require 'accessdb.php'; //open DB connection
require 'functions.php'; //reusable functions

//This is the logic for displaying all news
if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\''); //Query the news table
} else {
    //Query the news table for all published storeis, public only.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\' AND newspubpriv = \'Public\''); //Query the news table
}
//While
while ($row = $news->fetch()) 
{
    $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
    $author->execute([$row['newsauthor']]); //Execute the SQL statement
    $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
    $newsreturned = shorten_newsString($row['newstext'],'100',$row['newsid'],$row['newstitle']);
    echo "<h4><a href=\"index.php?loc=news&newsid=".$row['newsid']."\" title=\"".$row['newstitle']."\">".$row['newstitle']."</a><br><small>";
    echo "Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname']."</small></h4>";
    echo "<p>".$newsreturned."</p>";
}

$conn=null; //close DB connection
?>