<?php
require 'accessdb.php';

try {
$stmt = $conn->prepare("SELECT id, username, password, email FROM user WHERE username=".$_POST['username'])
$stmt->execute();
$result = $sth->fetch(PDO::FETCH_OBJ);
}
catch(PDOException $e) {
    echo "Error: ".$e->getMessage();
}
$conn=null;
print $result->name;

/*$options = [
    'cost' => 13,
];

$hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);*/

?>