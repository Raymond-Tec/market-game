<?php
    $input = 'https://thispersondoesnotexist.com/image';
    $output = 'image.jpg';
    file_put_contents($output, file_get_contents($input));
?>