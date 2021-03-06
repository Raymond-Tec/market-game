<?php 
//Lists all companies with page breaks at 25. Lists individual companies when one is specified.
//Lists search results 

$conn=accessdb();

//If business ID is not set in the URL, display all businesses
if (isset($_SESSION['username'])) {
    if (!isset($_GET['busid'])) {
        logevent('Viewed all businesses'); //Log the event
        
        $totPages = round($conn->query('SELECT COUNT(*) FROM businesses')->fetchColumn(),0);
        $formAction = "do_copage.php";
        if (!$_GET['pageid']) { $pageID = 1; }

        pagination( $pageID, $totPages, $formAction );

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
        pagination( $pageID, $totPages, $formAction );
    } elseif (isset($_GET['busid'])) { //If business ID is set in the URL, do this
        logevent('Viewed specific business id: '.$_GET['busid']);
        $bus = $conn->prepare('SELECT businessid, businessname, industryid, location_id FROM businesses WHERE businessid = ?');
        $bus->execute([$_GET['busid']]);
        $busResult = $bus->fetch(PDO::FETCH_ASSOC);

        try {
            $naics = $conn->prepare('SELECT naics_id, naics_description FROM naics WHERE naics_id = ?');
            $naics->execute([$busResult['industryid']]);
            $naicsResult = $naics->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        try {
            $location = $conn->prepare('SELECT id, city, state_id, lat, lng FROM geodata WHERE id = ?');
            $location->execute([$busResult['location_id']]);
            $locResult = $location->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        echo "<h4>".$busResult['businessname']."<br><small>";
        echo "Location: ".$locResult['city'].", ".$locResult['state_id']." | Industry: ".$naicsResult['naics_description']."</small></h4>";
        echo "<img src=\"https://maps.geoapify.com/v1/staticmap?style=osm-carto&width=600&height=400&center=lonlat:".$locResult['lng'].",".$locResult['lat']."&zoom=13&apiKey=a716d9040aa14673934b902911a4a019\" alt=\"".$locResult['city'].", ".$locResult['state_id']."\">";

    } elseif (isset($_GET['bussearch'])) {
        //SELECT * FROM businesses WHERE businessname LIKE '%Abbott%'
        //SELECT COUNT(businessname) FROM businesses WHERE businessname LIKE '%Abbott%'
        /*$totalquery
        $totPages = round($conn->query('SELECT COUNT(businessname) FROM businesses WHERE businessname LIKE \'%?%\'')->fetchColumn(),0);
        $formAction = "do_copage.php";
        if (!$_GET['pageid']) { $pageID = 1; }

        logevent('Viewed specific business id: '.$_GET['busid']);
        $bus = $conn->prepare('SELECT businessid, businessname, industryid, location_id FROM businesses WHERE businessid = ?');
        $bus->execute([$_GET['busid']]);
        $busResult = $bus->fetch(PDO::FETCH_ASSOC);

        try {
            $naics = $conn->prepare('SELECT naics_id, naics_description FROM naics WHERE naics_id = ?');
            $naics->execute([$busResult['industryid']]);
            $naicsResult = $naics->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        try {
            $location = $conn->prepare('SELECT id, city, state_id, lat, lng FROM geodata WHERE id = ?');
            $location->execute([$busResult['location_id']]);
            $locResult = $location->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        echo "<h4>".$busResult['businessname']."<br><small>";
        echo "Location: ".$locResult['city'].", ".$locResult['state_id']." | Industry: ".$naicsResult['naics_description']."</small></h4>";
        echo "<img src=\"https://maps.geoapify.com/v1/staticmap?style=osm-carto&width=600&height=400&center=lonlat:".$locResult['lng'].",".$locResult['lat']."&zoom=13&apiKey=a716d9040aa14673934b902911a4a019\" alt=\"".$locResult['city'].", ".$locResult['state_id']."\">";
*/
    } 
} else {
    logevent('Tried to view a company without being logged in business id: '.$_GET['busid']);
    $conn=null;
    header('Location: index.php');
    exit();
}
$conn=null; //close DB connection
?>