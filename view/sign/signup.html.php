<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

<?php require_once VIEW . DIRECTORY_SEPARATOR . 'error_messages.html.php'; ?>

<form class="border border-1 rounded p-3" action="" method="post">
    <div class=mb-3 mt-3>
    <label for="pseudo">Pseudo : </label>
    <input type="text" id="pseudo" name="pseudo">
    </div>

    <div class=mb-3 mt-3>
    <label for="email">Email : </label>
    <input type="email" id="email" name="email">
    </div>

    <div class=mb-3 mt-3>
    <label for="pwd">Password : </label>
    <input type="password" id="pwd" name="pwd">
    </div>

    <div class=mb-3 mt-3>
    <label for="conf_pwd">Confirm your pwd : </label>
    <input type="password" id="conf_pwd" name="conf_pwd">
    <!-- conf_pwd = confirm password -->
    </div>
    
    <button class="btn btn-primary border-1 border-dark" type="submit">Send</button>
</form>

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>