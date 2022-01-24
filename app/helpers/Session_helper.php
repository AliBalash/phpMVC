<?php
session_start();

function isLogin()
{
    if (isset($_SESSION['AUTH'])) {
        return true;
    } else
        return false;

}

