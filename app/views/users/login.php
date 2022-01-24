<?php
require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";
?>
<div style="margin: 100px 20% 0px 20% " class="formlogin">

    <h1 class="center">Login</h1>



    <form action=" <?= URLROOT; ?>public/users/login" method="post">
        <div class="center">

            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Username">
            <span class="invalidFeedback">
        <?= $data['usernameError'] ?>
    </span>
        </div>
        <hr>
        <div class="center">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Email">
            <span class="invalidFeedback">
        <?= $data['emailError'] ?>
    </span>
        </div>
        <hr>
        <div class="center">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password">
            <span class="invalidFeedback">
        <?= $data['passwordError'] ?>
    </span>
        </div>
        <br>
        <br>

        <div class="center">
            <button type="submit" name="submit">submit</button>

            <p class="white">Not register yet? <a class="green" href="<?= URLROOT ?>public/users/register">Create an
                    account</a></p>

        </div>
    </form>


</div>
