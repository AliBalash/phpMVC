<?php

require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";

?>


<h1 class="center green"><?= $data['titlePage'] ?></h1>
<div style="margin: 50px auto;width: 50%" class="formpost">


    <form action="<?= URLROOT . "public/posts/edit/".$data['post_id']; ?>" method="post" enctype="multipart/form-data">


        <div class="">
            <label for="title">title</label>
            <input id="username" type="text" name="title" placeholder="title..." <?php if (!empty($data['title'])){ ?> value="<?= $data['title'] ?><?php } ?>">
            <span class="invalidFeedback">
        <?= $data['titleError'] ?>
         </span>
        </div>


        <label for="description">Description</label>
        <div class="">
            <textarea name="description" id="description" cols="100" rows="10" placeholder="Description..."><?php if (!empty($data['description'])){echo $data['description'];} ?></textarea>
            <span class="invalidFeedback">
        <?= $data['descriptionError'] ?>
    </span>
        </div>


        <label for="image">image</label>
        <img style="margin-top: 20px" height="50" width="80" src="<?= '../'.UPLOADFILE. $data['image'] ?>" >
        <input id="image" type="file" name="image">
        <span class="invalidFeedback">
        <?= $data['imageError'] ?>
    </span>


        <label for="created_at">Create_at</label>
        <input id="created_at" type="date" value="<?= $data['created_at']; ?>" name="created_at">
        <span class="invalidFeedback">
        <?= $data['created_atError'] ?>
    </span>
        <br>
        <br>
        <div class="center">
            <button type="submit" name="submit">submit</button>
        </div>
    </form>

</div>
