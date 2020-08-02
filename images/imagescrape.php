<?php
    $ch = curl_init("https://thispersondoesnotexist.com/image");
    $fp = fopen("image.jpg", "w");

    curl_setopt($ch, CURLOPT_FILE, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);
    if(curl_error($ch)) {
        fwrite($fp, curl_error($ch));
    }
    curl_close($ch);
    fclose($fp);
?>