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


    <div style="margin: 20px;padding: 20px;text-align: center">
        <h1><?= $data->title ?></h1>

        <?php if ($data->image) {
                ?>
                <img class="detailimg" src="<?= '../../assets/upload/'. $data->image ?>" >
            <?php } ?>

            <p><?= $data->description ?></p>
            <br>
            <strong><?= $data->created_at ?></strong>
            <hr>
    </div>
    <hr>
    <hr>


</div>