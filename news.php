<h1>Market Game News</h1>
<?php
require 'accessdb.php'; //open DB connection

if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    echo "Here 1.\n";
    $news = $conn->query("SELECT newsid, newstitle, newdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = 'Published'");
    echo "Here 2.\n";
    while ($row = $news->fetch()) 
    {
        echo $row['newstitle']."\n";
    }
    echo "<p>Logged in news.";
} else {
    //Query the news table for all published storeis, public only.
    $stmt = $conn->prepare("SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = 'Published' AND newspubpriv = 'Public'"); //Query the news table
    echo "<p>Logged out news.";
}

$conn=null; //close DB connection
?>