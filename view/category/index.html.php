<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

<span>Bonjour <?= (isset($_SESSION['user'])) ? $_SESSION['user']->getPseudo() : "invité mystère"; ?> !</span>

<!-- Display all categories -->
<?php foreach ($categories as $category) : ?>
    <category id="category<?= $category->getIdCategory() ?>">
        <h1><?= filter_var($category->getName(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <p><?= filter_var($category->getDescription(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
        </p>

        <a href="<?= sprintf("/category/show/%d", $category->getIdCategory()) ?>">Display category</a>
        <?php if (isset($_SESSION['user'])) : ?>
            <a href="<?= sprintf("/category/edit/%d", $category->getIdCategory()) ?>">Edit category</a>
            <a href="<?= sprintf("/category/delete/%d", $category->getIdCategory()) ?>">Delete category</a>
        <?php endif; ?>
        </article>
    <?php endforeach; ?>

    <?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>