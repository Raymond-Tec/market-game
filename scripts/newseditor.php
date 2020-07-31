<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $allowed = checkAccess($_SESSION['usergroup'], 1);
    } else {
        header('Location: index.php');
    }
?>
<script src="https://cdn.tiny.cloud/1/w4f9bk41z1tex26ckbeq3lhf53d8txmayk0wvr9ry6yt22ip/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    })
</script>
<?php
    if (isset($_GET['newsid'])) {

    }
?>
<div class="container bg-light">
    <div class="row p-3">
        <div class="col">
            <label for="newstitle">Newstitle:</label>
            <input type="text" class="">
        </div>
        <div class="col">
            <form method="post">
                <textarea id="mytextarea" name="mytextarea">
                    Hello, World!
                </textarea>
            </form>
        </div>
    </div>
</div>
