<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php
        for($x=317; $x <= 1000; $x++) {
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
                echo "Image file: ".$filename." written.<br><br>";
                sleep(.5);
            }
        }
        ?>        
        <script src="" async defer></script>
    </body>
</html>
