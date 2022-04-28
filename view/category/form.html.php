<form action="" method="post">
    <label for="name">Name : </label>
    <input type="text" id="name" name="name" value="<?= isset($category) ? $category->getName() : ""; ?>">
    <br>
    <label for="description">Description : </label>
    <textarea name="description" id="description" cols="30" rows="10"><?= isset($category) ? $category->getDescription() : ""; ?></textarea>
    <button type="submit">Send</button>
</form>