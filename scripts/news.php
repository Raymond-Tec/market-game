<h2>News</h2>
<?php
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
    logevent('Viewed all news');
    while ($newsResult = $news->fetch()) 
    {
        $author = ret_nick($newsResult['newsauthor']);
        $newsreturned = shorten_newsString($newsResult['newstext'],'100',$newsResult['newsid'],$newsResult['newstitle']);
        echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
        echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
        echo "<p>".$newsreturned."</p>";
    }
} else {
    logevent('Viewed specific news id: '.$_GET['newsid']);
    //If news ID is set in the URL, display that specific news item in full.
    $news = $conn->prepare('SELECT newsid, newstitle, newsdate, newsauthor, newstext, newsstatus, newspubpriv FROM news WHERE newsid = ?');
    $news->execute([$_GET['newsid']]);
    $newsResult = $news->fetch(PDO::FETCH_ASSOC);
    $author = ret_nick($newsResult['newsauthor']);
    //If news item is published and public, display it.
    if ($newsResult['newsstatus']=='Published' && $newsResult['newspubpriv']=='Public') {
        echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
        echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
        echo "<p>".$newsResult['newstext']."</p>";
    //If news item is published and private, make sure the user is logged in.
    } elseif ($newsResult['newspubpriv']=='Private' && isset($_SESSION['username'])) {
        echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
        echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
        echo "<p>".$newsResult['newstext']."</p>";
    //If the news item isn't published, or is private and user isn't logged in, send back to welcome screen.
    } else {
        logevent('Tried to view a private news article while not logged in.');
        header('Location: index.php');
    }
}
$conn=null; //close DB connection
?>