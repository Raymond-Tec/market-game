<?php
//Open a database connection
function accessdb() {
    require 'dbcreds.php'; //Grab the database credentials
    try {
        $conn = new PDO($dsn, $dbun, $dbpw, $options);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br><br>"; //Error handling
    }
    return $conn;
}

//Create a function to send all actions to a log file
//Format log: <datetime> <remote_IP> <remote_useragent> <username if logged in> <-Provided by function Passed to function -> <action>
//Create a separate php file to load all logs into database every 24 hours.
function logevent($action) {
    require 'mgstats.php';
    //Pull the username or enter not logged in.
    if($_SESSION['username']) { $remoteUN = $_SESSION['username']; } else { $remoteUN = "Not Logged In"; } 
    $logTime = date('Y-m-d H:i:s');
    $entry = $logTime." ".$action." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_USER_AGENT']." ".$remoteUN;
    file_put_contents($gamePath.'//logs/'.date('Y-m-d').'.log',$entry, FILE_APPEND);
    return;
}

/*Returns the first $wordsreturned out of $string. If string contains fewer words than $wordsreturned, the entire string 
is returned. newsID and newstitle added by RT to create More link.*/
function shorten_newsString($string, $wordsreturned, $newsid, $newstitle) {
    $retval = $string;      //  Just in case of a problem
    $array = explode(" ", $string); //Takes the string and explodes it into an array using the <space> as a separator

    if (count($array)<=$wordsreturned) {  //  Already short enough, return the whole thing
        $retval = $string;
    } else { // It's not short enough chop off words after wordsreturned.
        array_splice($array, $wordsreturned); //Cuts the array off after wordsreturned
        $retval = implode(" ", $array)." ... <a href=\"index.php?loc=news&newsid=".$newsid."\" title=\"".$newstitle."\">More</a>"; //Creates the return string with More link
    }
        return $retval;
}

//Return user's nickname from user ID
function ret_nick($nickID) {
    $conn = accessdb();
    $nickname = $conn->prepare('SELECT userid, nickname FROM user WHERE userid = ?'); //Prepare SQL statement to find the Author's nickname from the userid on the post
    $nickname->execute([$nickID]); //Execute the SQL statement
    $nickResult = $nickname->fetch(PDO::FETCH_ASSOC); //Put the statement into an associative array
    $retval = $nickResult['nickname'];
    $conn=null;
    return $retval;
}

//Check user access return to index for not authorized, 1 for authorized
function checkAccess($group, $accessRequired) {
    if ($group > $accessRequired) {
        $retval = 0;
        header('Location: index.php');
    } else {
        $retval = 1;
    }
    return $retval;
}

//Send emails to users
function sendMail($uemail, $subj, $body, $sender) {
    require 'mgstats.php';
    $msg=wordwrap($body,70);
    $headers = 'From: '.$sender.'@'.$gameDomain."\r\n".'Reply-To: '.$sender.'@'.$gameDomain.'.com'."\r\n".'X-Mailer: PHP/'.phpversion();
    mail($uemail,$subj,$msg,$headers);
}
?>