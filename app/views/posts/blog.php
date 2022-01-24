<?php

require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";

?>
<h1 class="center green">Blog</h1>


<div class="container">

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="message">
            <p><?= $_SESSION['message']; ?></p>
        </div>
    <?php unset($_SESSION['message']); } ?>


    <div style="margin: 20px;padding: 20px">
        <?php foreach ($data as $post) : ?>
            <?php if ($post->image) { ?>
        <a href="<?= URLROOT.'public/posts/detail/'.$post->id ?>"><img class="postimg" src="<?= '../'.UPLOADFILE. $post->image ?>" >
            <?php } ?>
            <h2><?= $post->title ?></h2></a>

            <p><?= $post->description ?></p>
            <br>
            <strong><?= $post->created_at ?></strong>
            <hr>
        <?php endforeach; ?>
    </div>
    <hr>
    <hr>


</div>