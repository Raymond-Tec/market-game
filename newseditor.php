<?php
    session_start();
    $allowed = checkAccess($_SESSION['usergroup'], 0);
if ($allowed == 0){
    header('Location: index.php');
} ?>
<script src="https://cdn.tiny.cloud/1/w4f9bk41z1tex26ckbeq3lhf53d8txmayk0wvr9ry6yt22ip/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#mytextarea'
    })
</script>
<form method="post">
    <textarea id="mytextarea" name="mytextarea">
        Hello, World!
    </textarea>
</form>