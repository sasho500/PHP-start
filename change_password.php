<?php
session_start();

if (!(array_key_exists('username', $_SESSION) && $_SESSION['username'])) {
    header("Location: http://dev.sashosocial.com/login-form.php");
    die();
}

if (isset($_POST) && array_key_exists('password', $_POST)) {

    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_password = $_POST['password'];
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="col-sm-6">
        <?php if (array_key_exists('username', $_SESSION) && $_SESSION['username']) { ?>
            <div class="row">
                <div class="col-6">
                    <div class="list-group">
                        <a href="/edit_profile.php" class="list-group-item list-group-item-action ">Edit
                            profile</a>
                        <a href="/change_password.php" class="list-group-item list-group-item-action active">Change
                            password</a>
                        <a href="logout.php" name="1" class="list-group-item list-group-item-action ">Logout </a>

                        <a href="/delete.php"
                           class="list-group-item list-group-item-action text-danger">Delete
                            profile</a>
                    </div>
                </div>

                <div class="col-6">
                    <form action="change_password.php" method="post">

                        <?php if (array_key_exists("error", $_GET)) { ?>
                            <p class="error"><?php echo $_GET['error'] ?></p>

                        <?php } else if (array_key_exists("success", $_GET)) { ?>
                            <p class="success"><?php echo $_GET['success'] ?></p>
                        <?php } ?>
                        <fieldset>


                            <div class="form-group">
                                <label for="password" class="form-label mt-4">Password</label>
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="password"

                                >

                            </div>


                            <div class="form-group">
                                <label for="new_password" class="form-label mt-4">New password</label>
                                <input type="password"
                                       class="form-control"
                                       id="new_password"
                                       name="new_password"
                                       placeholder="new password"

                                >

                            </div>


                            <div class="form-group">
                                <label for="confirm_password" class="form-label mt-4">Confirm password</label>
                                <input type="password"
                                       class="form-control"
                                       id="confirm_password"
                                       name="confirm_password"
                                       placeholder="confirm password"

                                >

                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </fieldset>
                    </form>

                </div>
            </div>


        <?php } ?>
    </div>