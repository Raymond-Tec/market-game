<?php
for($x=0; $x <= 100; $x++) {
    //$ch = curl_init("https://thispersondoesnotexist.com/image");
    $filename = sprintf("%05d",$x).".jpg";
    echo $filename."<br>";
    /*$fp = fopen("image.jpg", "w");

    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);
    if(curl_error($ch)) {
        fwrite($fp, curl_error($ch));
    }
    curl_close($ch);
    fclose($fp);
    sleep(5);*/
}
?>