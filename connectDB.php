<?php
$db_host = "localhost";
$db_name = "api test";
$db_user = "root";
$db_pass = "";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$pdo->exec("set names utf8");