<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

    <article id="category<?= $category->getIdCategory() ?>">
        <h1><?= filter_var($category->getName(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <p><?= nl2br(filter_var($category->getDescription(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>

        <?php if (isset($_SESSION['user'])) : ?>
            <a href="<?= sprintf("/category/edit/%d", $category->getIdCategory()) ?>">Edit category</a>
            <a href="<?= sprintf("/category/delete/%d", $category->getIdCategory()) ?>">Delete category</a>
        <?php endif; ?>
        </article>

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>