
<?php

$pw = test;

$options = [
    'cost' => 12,
];

$sha3pw = hash('sha3-512','test');
$defaultpw = password_hash($pw, PASSWORD_BCRYPT, $options);
$combinedpw = password_hash($sha3pw, PASSWORD_BCRYPT, $options);

echo $pw.'<br>';
echo 'SHA3-512 hashed password: ' . $sha3pw .'<br>';
echo 'Built-in hashed password: ' . $defaultpw .'<br>';
echo 'Combined password: ' . $combinedpw;