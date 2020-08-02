<?php
    $input = 'https://thispersondoesnotexist.com/image';
    echo "URL to open: ".$input."<br><br>";
    $output = 'image.jpg';
    echo "File to be saved to: ".$output."<br><br>";
    file_put_contents($output, file_get_contents($input));
    echo "See the <a href=\"".$output."\">file here</a>";
?>