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

//Create a separate php file to load all logs into database every 24 hours.

//Log event function. Pass the action that was completed to this function, it handles the rest.
function logevent($action) {
    require 'mgstats.php';
    //Pull the username or enter "Not Logged In"
    if($_SESSION['username']) { $remoteUN = $_SESSION['username']; } else { $remoteUN = "Not Logged In"; } 
    $logTime = date('Y-m-d H:i:s'); //Establish Log time.
    $sid = session_id(); //Session ID
    $entry = $logTime."|".$action."|".$_SERVER['REMOTE_ADDR']."|".$_SERVER['HTTP_USER_AGENT']."|".$remoteUN."|".$sid."\n"; //Create the variable for log entry
    $filename = "logs/".date('Y-m-d').".log"; //Build filename, changes by day.
    file_put_contents($filename,$entry, FILE_APPEND); //Appends the entry to the log file.
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

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 75, $d = 'mp', $r = 'g', $img = TRUE, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

//Funciton to create the pagination
function pagination( $pageID, $totalPages, $formAction ) {
    ?>
    <form action="scripts/<?php echo $formAction; ?>" class="form-inline" id="pageform" method="post" autocomplete="off">
    <div class="container bg-light small">
        <div class="row">
            <div class="col-6">
                <input type="text" id="pagenum" class="form-control input-sm" name="pagenum" size="3" value="<?php echo $pageID; ?>"> of <?php echo $totalPages; ?> Pages <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <div class="col-6">
                <input type="text" size="15" placeholder="Search Business Names" id="search" class="form-control input-sm" name="search"><input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </div>
    </form>
    <?php
    return;
}
?>