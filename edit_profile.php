<?php

session_start();
include "functions.php";

$is_log_in = $_SESSION;

check_if_user_is_login($is_log_in);

$data = $_POST;
edit_profile($data);

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
                        <a href="/edit_profile.php" class="list-group-item list-group-item-action active">Edit
                            profile</a>
                        <a href="/change_password.php" class="list-group-item list-group-item-action">Change
                            password</a>
                        <a href="logout.php" class="list-group-item list-group-item-action">Logout
                        </a>
                        <a href="/delete.php" class="list-group-item list-group-item-action text-danger">Delete
                            profile</a>
                    </div>
                </div>

                <div class="col-6">
                    <form action="edit_profile.php" method="post">
                        <fieldset>

                            <?php if (array_key_exists("error", $_GET)) { ?>
                                <p class="error"><?php echo $_GET['error'] ?></p>

                            <?php } else if (array_key_exists("success", $_GET)) { ?>
                                <p class="success"><?php echo $_GET['success'] ?></p>
                            <?php } ?>

                            <div class="form-group">
                                <label for="username" class="form-label mt-4">Change Username</label>
                                <input type="text"
                                       class="form-control"
                                       id="username"
                                       name="username"
                                       placeholder="Username"
                                       value="<?php echo $_SESSION['username'] ?>"
                                >

                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </fieldset>
                    </form>

                </div>
            </div>


        <?php } ?>
    </div>