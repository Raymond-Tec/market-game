<?php
    session_start();
    $allowin = 0;
    $allowed = checkAccess($_SESSION['usergroup'], $allowedin);
if ($allowed == 0){
    echo "User group: ".$_SESSION['usergroup'];
    echo "Group allowed in: ".$allowin;
    echo "Allowed value: ".$allowed;
} ?>

<div class="container bg-light">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <a href="index.php?loc=newseditor" alt="News Editor">News Editor</a>
        </div>
    </div>
</div>