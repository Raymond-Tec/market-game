<?php
//https://randommer.io/api/Name/Suggestions
//X-Api-Key: 478ca5d614ed432b828833a79d2b012d

$url = 'https://randommer.io/api/Name?nameType=fullname&quantity=1000'; // URL to site
$apiKey = 'X-Api-Key: 478ca5d614ed432b828833a79d2b012d'; // MY API key

$curl = curl_init($url); //Create the session
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, [
    $apiKey
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response . PHP_EOL;
?>