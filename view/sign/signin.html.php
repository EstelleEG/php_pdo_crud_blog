<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

<?php require_once VIEW . DIRECTORY_SEPARATOR . 'error_messages.html.php'; ?>

<form action="" method="post">
    <label for="email">Email : </label>
    <input type="email" name="email" id="email">
    <br>
    <label for="pwd">Password : </label>
    <input type="password" name="pwd" id="pwd">
    <br>
    <button class="btn btn-primary" type="submit">Send</button>
</form>

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>