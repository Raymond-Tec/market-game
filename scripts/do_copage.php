<?php
require 'functions.php';

if (isset($_POST['pageid'])) {
    header("Location: index.php?loc=companyview&pageid=".$_POST['pageid']);
    exit();
} elseif (isset($_POST['search'])) {
    header("Location: index.php?loc=companyview&bussearch=".$_POST['search']);
    exit();
}