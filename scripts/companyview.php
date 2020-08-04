<?php //Lists all companies with page breaks at 25. Lists individual companies when one is specified.

$conn=accessdb();

//If business ID is not set in the URL, display all businesses
if (!isset($_GET['busid']) && isset($_SESSION['username'])) {
    logevent('Viewed all businesses'); //Log the event
    
    $totRecs = $conn->query('SELECT COUNT(*) FROM businesses')->fetchColumn();
    $totPages = round($totRecs/25,0);
    echo "Page ID: ".$_GET['pageid']."<br>";
    ?>



    <?php
    if (!isset($_GET['pageid'])) {
        $bus = $conn->query('SELECT businessid, businessname, industryid, location_id FROM businesses');
        
        $x = 0;
        
        while ($busResult = $bus->fetch()) 
        {
            try {
                $naics = $conn->prepare('SELECT naics_id, naics_description FROM naics WHERE naics_id = ?');
                $naics->execute([$busResult['industryid']]);
                $naicsResult = $naics->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            try {
                $location = $conn->prepare('SELECT id, city, state_id FROM geodata WHERE id = ?');
                $location->execute([$busResult['location_id']]);
                $locResult = $location->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            echo "<h4><a href=\"index.php?loc=companyview&busid=".$busResult['businessid']."\" title=\"".$busResult['businessname']."\">".$busResult['businessname']."</a><br><small>";
            echo "Location: ".$locResult['city'].", ".$locResult['state_id']." | Industry: ".$naicsResult['naics_description']."</small></h4>";
            if ($x == 25) { break; }
            $x++;
        }
    } else {
        $bus = $conn->query('SELECT businessid, businessname, industryid, location_id FROM businesses');
        
        $x = 0;
        
        while ($busResult = $bus->fetch()) 
        {
            try {
                $naics = $conn->prepare('SELECT naics_id, naics_description FROM naics WHERE naics_id = ?');
                $naics->execute([$busResult['industryid']]);
                $naicsResult = $naics->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            try {
                $location = $conn->prepare('SELECT id, city, state_id FROM geodata WHERE id = ?');
                $location->execute([$busResult['location_id']]);
                $locResult = $location->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            echo "<h4><a href=\"index.php?loc=companyview&busid=".$busResult['businessid']."\" title=\"".$busResult['businessname']."\">".$busResult['businessname']."</a><br><small>";
            echo "Location: ".$locResult['city'].", ".$locResult['state_id']." | Industry: ".$naicsResult['naics_description']."</small></h4>";
            if ($x == 25) { break; }
            $x++;
        }

    }
} elseif (isset($_GET['busid']) && isset($_SESSION['username'])) {
    /*
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
    } elseif ($newsResult['newsstatus']=='Published' && $newsResult['newspubpriv']=='Private' && isset($_SESSION['username'])) {
        echo "<h4><a href=\"index.php?loc=news&newsid=".$newsResult['newsid']."\" title=\"".$newsResult['newstitle']."\">".$newsResult['newstitle']."</a><br><small>";
        echo "Published On: ".$newsResult['newsdate']." | Written by: ".$author."</small></h4>";
        echo "<p>".$newsResult['newstext']."</p>";
    //If the news item isn't published, or is private and user isn't logged in, send back to welcome screen.
    } else {
        logevent('Tried to view a private, draft, or non-existent news id: '.$_GET['newsid']);
        header('Location: index.php');
    }
    */
} elseif (isset($_GET['bussearch'])) {

} else {
    logevent('Tried to view a company without being logged in business id: '.$_GET['busid']);
    $conn=null;
    header('Location: index.php');
    exit();
}
$conn=null; //close DB connection
?>