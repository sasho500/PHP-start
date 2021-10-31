<?php
session_start();
include "functions.php";
if (isset($_POST) && array_key_exists('username', $_POST)) {

    $connection = mysqli_connect('localhost', 'root', "", 'loginapp');
    $data=$_POST;
    if (!$connection) {
        echo "No con";
        return;
    }



login_user($data,$connection);
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
                        <a href="/edit_profile.php" class="list-group-item list-group-item-action">Edit profile</a>
                        <a href="/change_password.php" class="list-group-item list-group-item-action">Change
                            password</a>
                        <a href="logout.php" class="list-group-item list-group-item-action">Logout
                        </a>
                        <a href="/delete.php" class="list-group-item list-group-item-action text-danger">Delete
                            profile</a>
                    </div>
                </div>

                <div class="col-6">
                    <h1>Hello, <?php echo $_SESSION['username'] ?> </h1>
                </div>
            </div>


        <?php } else { ?>
            <form action="login-form.php" method="post">
                <?php if (array_key_exists("error", $_GET)) { ?>
                    <p class="error"><?php echo $_GET['error'] ?></p>

                <?php } else if (array_key_exists("success", $_GET)) { ?>
                    <p class="success"><?php echo $_GET['success'] ?></p>
                <?php } ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password </label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        <?php } ?>
    </div>
</div>

</body>
</html>