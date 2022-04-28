<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="/category">Categories</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <li class="nav-item"><a class="nav-link" href="/category/new">New category</a></li>
                <li class="nav-item"><a class="nav-link" href="/article/new">New article</a></li>
                <li class="nav-item"><a class="nav-link" href="/signout">Log out</a></li>
            <?php else : ?>
                <li class="nav-item"><a class="nav-link" href="/signup">Sign up</a></li>
                <li class="nav-item"><a class="nav-link" href="/signin">Log in</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>