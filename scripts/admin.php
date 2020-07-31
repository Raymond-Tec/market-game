<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $allowed = checkAccess($_SESSION['usergroup'], 1);
    } else {
        header('Location: index.php');
    }
?>
<div class="container bg-light">
    <div class="row">
        <div class="col">
            <h2>Administration</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <a href="index.php?loc=newseditor" alt="News Editor">News Editor</a>
        </div>
    </div>
</div>