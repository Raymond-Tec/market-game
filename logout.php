<?php
//Remove all session variables
session_unset();
//Destroy the session
session_destroy();
?>
You have been logged out.<br><br>
You will be redirected to the Welcome page shortly.
<?php
header('Refresh: 2; Location: index.php');
?>