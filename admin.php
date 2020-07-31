<?php
    session_start();
    $allowed = checkAccess($_SESSION['usergroup'], 0);
if ($allowed == 0){
    header('Location: index.php');
} ?>

<div class="container bg-light">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <a href="index.php?loc=newseditor" alt="News Editor">News Editor</a>
        </div>
    </div>
</div>