<h1>Market Game News</h1>
<?php
require 'accessdb.php'; //open DB connection

if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
        $author->execute([$row['newsauthor']]); //Execute the SQL statement
        $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
        echo "<h2>".$row['newstitle']."</h2>";
        echo "<h4>"."Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname']." | Status: ".$row['newspubpriv'];
        echo "<p>".$row['newstext']."</p>";
    }
} else {
    //Query the news table for all published storeis, public only.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\' AND newspubpriv = \'Public\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
        $author->execute([$row['newsauthor']]); //Execute the SQL statement
        $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
        echo "<h2>".$row['newstitle']."</h2>";
        echo "<h4>"."Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname'];
        echo "<p>".$row['newstext']."</p>";
    }
}

$conn=null; //close DB connection
?>