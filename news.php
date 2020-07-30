<?php
require 'accessdb.php'; //open DB connection


if (isset($_SESSION["username"])) {
    //Query the news table for all published stories, public and private.
    $stmt = $pdo->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\'');
    foreach ($stmt as $row)
    {
        echo "<h2>".$row['newstitle']."</h2>";
        echo "<h4>".$row['newsdate']."</h4>";
        echo "<p>Author: ".$row['newsauthor']."</p>";
        echo "<p>".$row['newstext']."</p>";
    }
} else {
    //Query the news table for all published storeis, public only.
    $stmt = $conn->prepare("SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = 'Published' AND newspubpriv = 'Public'"); //Query the news table
}

$conn=null; //close DB connection
?>