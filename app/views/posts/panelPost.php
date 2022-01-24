<?php

require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";

?>

<h1 class="blue center">Panel post</h1>
<?php if (isset($_SESSION['message'])) { ?>
    <div class="message">
        <p><?= $_SESSION['message']; ?></p>
    </div>
    <?php unset($_SESSION['message']); } ?>

<div class="table">
    <a style="margin: 0px 25%" class="info bkgreen" href="<?= URLROOT . "public/posts/createpost" ?>">Add Post</a>
    <table>

        <th>id</th>
        <th>User Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Create at</th>
        <th>image</th>
        <th>Info</th>

        <?php foreach ($data as $post) : ?>

            <tr>
                <td><?= $post->id ?></td>
                <td><?= $post->user_id ?></td>
                <td><?= $post->title ?></td>
                <td><?= substr_replace($post->description, "...", 30); ?></td>
                <td><?= $post->created_at ?></td>
                <td><img height="50" width="80" src="<?= '../'.UPLOADFILE. $post->image ?>" ></td>
                <td style="width: 200px">
                    <a class="info bkpurple" href="<?= URLROOT . "public/posts/detail/" . $post->id; ?>">Detail</a>
                    <a class="info bkorange" href="<?= URLROOT . "public/posts/Edit/" . $post->id; ?>">Edit</a>
                    <a class="info bkred" href="<?= URLROOT . "public/posts/Delete/" . $post->id; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</div>