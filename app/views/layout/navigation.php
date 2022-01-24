<nav style="background-color: antiquewhite">
    <ul style="margin: 0px;list-style-type: none">
        <li><a href="<?= URLROOT . "public/"; ?>">home</a></li>
        <li><a href="<?= URLROOT . "public/pages/Services"; ?>">Services</a></li>
        <li><a href="<?= URLROOT . "public/pages/project"; ?>">Project</a></li>
        <li><a href="<?= URLROOT . "public/pages/about"; ?>">About</a></li>
        <li><a href="<?= URLROOT . "public/posts/blog"; ?>">Blog</a></li>
        <li><a href="<?= URLROOT . "public/pages/contact"; ?>">Contact</a></li>

        <?php if (isset($_SESSION['role'])) : ?>
        <li><a href="<?= URLROOT . "public/posts/panelpost"; ?>">Panel Post</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['AUTH'])) {
            ?>
            <li><a style="color: red" href="<?= URLROOT . "public/users/logout"; ?>">Log out</a></li>

        <?php } else { ?>
            <li><a href="<?= URLROOT . "public/users/Login"; ?>">Login</a></li>
        <?php } ?>
    </ul>
</nav>

