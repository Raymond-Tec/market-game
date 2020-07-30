<h1>Market Game News</h1>
<?php
require 'accessdb.php'; //open DB connection

if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        echo "<h2>".$row['newstitle']."</h2>";
        echo "<h4>"."Published On: ".$row['newsdate']." | Written by: ".$row['newsauthor']." | Status: ".$row['newspubpriv'];
        echo "<p>".$row['newstext']."</p>";
    }
} else {
    //Query the news table for all published storeis, public only.
    $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\' AND newspubpriv = \'Public\''); //Query the news table
    while ($row = $news->fetch()) 
    {
        echo "<h2>".$row['newstitle']."</h2>";
        echo "<h4>"."Published On: ".$row['newsdate']." | Written by: ".$row['newsauthor'];
        echo "<p>".$row['newstext']."</p>";
    }
}

$conn=null; //close DB connection
?>