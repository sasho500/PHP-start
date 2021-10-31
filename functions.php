<?php


function delete_user($username, $password, $connection)
{
    $sql = "
    SELECT *
    FROM users
    WHERE  username='$username'
    ";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        echo "Invalid user";
        exit();
    }
    $result = $result->fetch_assoc();
    if (password_verify($password, $result['password'])) {
        $sql_delete_user = "
        DELETE FROM users
        WHERE  username='$username' 
        ";
        mysqli_query($connection, $sql_delete_user);
        session_destroy();
        header("Location:login-form.php?success=The  user has been deleted");
        exit();
    }
    header("Location:delete.php?error=Wrong password");
}


function create_user($user, $password, $connection)
{
    $query = "INSERT INTO users(username ,password) ";
    $query .= "VALUES ('$user','$password')";

    $result = mysqli_query($connection, $query);


    if (mysqli_errno($connection) === 1062) {
        header("Location:register_form.php?error=Already  registered");
        exit();

    }


    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user;
    header("Location:login-form.php");
}


function login_user($data, $connection)
{

    $username = $data['username'];

    $password = $data['password'];
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $query = "SELECT * FROM users WHERE username='$username'";

    $result = mysqli_query($connection, $query);


    if (!$result) {
        die("USER DOES NOT EXIST " . mysqli_error($connection));
    }

    $userResult = $result->fetch_assoc();


    if (password_verify($password, $userResult['password'])) {

        session_destroy();
        session_start();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;


    }
}

function logout_user()
{
    session_destroy();
    header("Location: http://dev.sashosocial.com/login-form.php");
}

function check_if_user_is_login($is_log_in)
{
    if (!(array_key_exists('username', $is_log_in) && $is_log_in['username'])) {
        header("Location: http://dev.sashosocial.com/login-form.php");
        die();
    }
}

function edit_profile($data)
{
    if (isset($data) && array_key_exists('username', $data)) {

        global $is_log_in;

        $username = $data['username'];
        $old_username = $_SESSION['username'];
        $connection = mysqli_connect('localhost', 'root', "", 'loginapp');

        if (!$connection) {
            echo "No con";
            return;
        }

        $update_query = "
        UPDATE users 
        SET username = '$username' 
        WHERE username='$old_username'
    ";


        $result = mysqli_query($connection, $update_query);
        if ($result) {
            $_SESSION['username'] = $username;

            header("Location:edit_profile?success=The  username  was  updated");
        }
    }
}

function change_password($data)
{
    if (isset($data) && array_key_exists('password', $data)) {

        $password = $data['new_password'];
        $confirm_password = $data['confirm_password'];
        $user_password = $data['password'];
        $username = $_SESSION['username'];


        $connection = mysqli_connect('localhost', 'root', "", 'loginapp');


        if (empty($user_password)) {
            header("Location:change_password.php?error=0ld Password is required");
            exit();
        }

        if (empty($password)) {
            header("Location:change_password.php?error=New Password is required");
            exit();
        }

        if ($password !== $confirm_password) {
            header("Location:change_password.php?error=The confirm password doesnt match");
            exit();
        }

        $password1 = password_hash($password, PASSWORD_BCRYPT);
        $sql = "SELECT * FROM users WHERE username='$username' ";
        $result = mysqli_query($connection, $sql);


        if (!$result) {
            echo "Invalid  user";
            session_destroy();
            header("Location:login-form.php");
            exit();
        }


        $result = $result->fetch_assoc();

        if (!password_verify($user_password, $result['password'])) {
            header("Location:change_password.php?error=0ld Password is invalid");
            exit();
        }
        $sql_update_password = "UPDATE users
            SET password='$password1'
            WHERE  username='$username'
            ";
        mysqli_query($connection, $sql_update_password);

        header("Location:change_password.php?success=Yor password has been change successfully1");
    }
}