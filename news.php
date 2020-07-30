<h2>News</h2>
<?php
require 'functions.php'; //reusable functions
$conn = accessdb();

if (!isset($_GET['newsid'])) {
    //If news ID is not set in the URL, display all news
    if (isset($_SESSION["username"])) {
        //Query the news table for all published stories, public and private.
        $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\'');
    } else {
        //Query the news table for all published storeis, public only.
        $news = $conn->query('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsstatus = \'Published\' AND newspubpriv = \'Public\'');
    }
    //While
    while ($newsResult = $news->fetch()) 
    {
        $author = ret_nick($newsResult['newsauthor']);
        $newsreturned = shorten_newsString($row['newstext'],'100',$row['newsid'],$row['newstitle']);
        echo "<h4><a href=\"index.php?loc=news&newsid=".$row['newsid']."\" title=\"".$row['newstitle']."\">".$row['newstitle']."</a><br><small>";
        echo "Published On: ".$row['newsdate']." | Written by: ".$auth_result['nickname']."</small></h4>";
        echo "<p>".$newsreturned."</p>";
    }
} else {
    $news = $conn->prepare('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsid = ?');
    $news->execute([$_GET['newsid']]);
    $newsResult = $news->fetch(PDO::FETCH_ASSOC);
    $author = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
    $author->execute([$newsResult['newsauthor']]); //Execute the SQL statement
    $auth_result = $author->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
    echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
    echo "Published On: ".$newsResult['newsdate']." | Written by: ".$auth_result['nickname']."</small></h4>";
    echo "<p>".$newsResult['newstext']."</p>";
}
$conn=null; //close DB connection
?>