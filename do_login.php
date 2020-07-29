<?php
//require 'accessdb.php';

$options = [
    'cost' => 13,
];

$hashedpw = password_hash('0o8xQ5!GgK350^N1!lU5jVWB*EHnBJS1', PASSWORD_BCRYPT, $options);

echo $hashedpw;

?>