<?php
for($x=1026; $x <= 2500; $x++) {
    $ch = curl_init("https://thispersondoesnotexist.com/image");
    $filename = sprintf("%05d",$x).".jpg";
    $fp = fopen($filename, "w");

    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);
    if(curl_error($ch)) {
        echo curl_error($ch)."<br><br>";
    } else {
        curl_close($ch);
        fclose($fp);
        sleep(2);
    }
}
