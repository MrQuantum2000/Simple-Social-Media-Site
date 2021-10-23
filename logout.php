<?php
session_start();

if(isset($_SESSION['nsl_userid']))
{
    $_SESSION['nsl_userid'] = NULL;
    unset($_SESSION['nsl_userid']);
}

header("Location: login.php");
die;
