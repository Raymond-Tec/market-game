<h2>News</h2>
<?php
require 'accessdb.php'; //open DB connection
require 'functions.php'; //reusable functions

//This is the logic for displaying all news
if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
        $author->execute([$row['newsauthor']]); //Execute the SQL statement
        $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
        $newsreturned = shorten_string($row['newstext'],'100');
        echo "<h4>".$row['newstitle']."<br><small>";
        echo "Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname']." | Status: ".$row['newspubpriv']."</small></h4>";
        echo "<p>".$newsreturned."</p>";
    }
} else {
    //Query the news table for all published storeis, public only.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\' AND newspubpriv = \'Public\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
        $author->execute([$row['newsauthor']]); //Execute the SQL statement
        $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
        echo "<h4>".$row['newstitle']."<br><small>";
        echo "Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname']."</small></h4>";
        echo "<p>".$row['newstext']."</p>";
    }
}

$conn=null; //close DB connection
?>