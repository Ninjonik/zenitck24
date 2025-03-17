<?php 

$db = "zenit_ck_za_2";
$user = "zenit_user_40_2";
$pass = "zenit_pass_40_2";
$host = "localhost";

$db = new mysqli($host, $user, $pass, $db);
$db->set_charset("utf8mb4");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
