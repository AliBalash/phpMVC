<?php
require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";
?>

<h1 class="center green">Home</h1>


<div class="lastpost">

    <div class="container center">
        <h2 style="text-align: start;margin-left: 30px">Last Post</h2>
        <hr>
        <?php foreach ($data as $post) : ?>
            <div class="cart">
                <?php if ($post->image) {
                    ?>
                    <a href="<?= URLROOT.'public/posts/detail/'.$post->id ?>"><img src="<?= UPLOADFILE . $post->image ?>"></a>
                <?php } ?>
                <h2><?= $post->title ?></h2>

                <strong><?= $post->created_at ?></strong>
            </div>

        <?php endforeach; ?>

    </div>


</div>


