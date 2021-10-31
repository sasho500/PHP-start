<?php
session_start();
include "db.php";
include "functions.php";


if (isset($_POST) && array_key_exists('password', $_POST)) {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    global $connection;

    delete_user($username,$password,$connection);
}