<?php
    $handle = $curl_init();
    $url = "https://thispersondoesnotexist.com/image";

    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($handle);
    curl_close($handle);
    echo $output;
?>