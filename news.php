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
        $newsreturned = shorten_newsString($newsResult['newstext'],'100',$newsResult['newsid'],$newsResult['newstitle']);
        echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
        echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
        echo "<p>".$newsreturned."</p>";
    }
} else {
    $news = $conn->prepare('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsid = ?');
    $news->execute([$_GET['newsid']]);
    $newsResult = $news->fetch(PDO::FETCH_ASSOC);
    if ($newsResult['newsstatus']=='Published') {
        if ($newsResult['newspubpriv']=='Private' && isset($_SESSION['username']) || $newsResult['newspubpriv']=='Public' && !isset($_SESSION['username'])) {
            $author = ret_nick($newsResult['newsauthor']);
            echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
            echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
            echo "<p>".$newsResult['newstext']."</p>";
        }
    } else {
        header('Location: index.php');
    }
}
$conn=null; //close DB connection
?>