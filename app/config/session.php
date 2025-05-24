<?php 

session_start();

if(!isset($_SESSION) || !isset($_SESSION['user']))
{
    header('location:'.BASE_URL.'/auth/login.php');
    exit;
}