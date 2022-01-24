<?php
require APPROOT . "/views/layout/header.php";
require APPROOT . "/views/layout/navigation.php";
?>
<div style="margin: 100px 20% 0px 20%" class="formlogin">
    <h1 class="center">Register</h1>

    <form action="<?= URLROOT; ?>public/users/register" method="post">

        <div class="center"><label for="username">username</label>
            <input id="username" type="text" name="username" placeholder="Username">
            <span class="invalidFeedback">
        <?= $data['usernameError'] ?>
         </span>
        </div>
        <hr>

        <div class="center">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" placeholder="Email">
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
        <hr>

        <div class="center">
            <label for="confirmPassword">Confirm Password</label>
            <input id="confirmPassword" type="password" name="confirmPassword" placeholder="Confirm Password">
            <span class="invalidFeedback">
        <?= $data['confirmPasswordError'] ?>
             </span>
        </div>

        <br>
        <br>
        <div class="center">
            <button type="submit" name="submit">submit</button>
        </div>

    </form>


</div>
