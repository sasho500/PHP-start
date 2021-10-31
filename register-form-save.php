<?php
include "functions.php";
session_start();
if (isset($_POST) && count($_POST)) {
    $user = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $connection = mysqli_connect('localhost', 'root', "", 'loginapp');

    if ($connection) {
        echo "We are connected";
        echo "<br>";
    } else {

        die("Database connection failed");
        echo "<br>";
    }


   create_user($user,$password,$connection);

    return;
//echo $query;
//if ($user&&$password)
//{
//    echo $user;
//    echo "<br>";
//    echo $password;
//}
//else  {
//    echo "Username  is  not  set";
//}
//echo $user;
//echo "<br>";
//echo $password;
}

echo 'nothing here';