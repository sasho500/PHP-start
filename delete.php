<?php
session_start();


if (isset($_POST) && array_key_exists('password', $_POST)) {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    $connection = mysqli_connect('localhost', 'root', "", 'loginapp');

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
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-3">
            <div class="list-group">
                <a href="/edit_profile.php" class="list-group-item list-group-item-action ">Edit
                    profile</a>
                <a href="/change_password.php" class="list-group-item list-group-item-action ">Change
                    password</a>
                <a href="logout.php" name="1" class="list-group-item list-group-item-action ">Logout </a>

                <a href="/delete.php"
                   class="list-group-item list-group-item-action  text-white bg-danger ">Delete
                    profile</a>
            </div>
        </div>
        <div class="col-9">
            <form action="delete.php" method="post">

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
                </fieldset>
                <button   class="btn btn-danger">DELETE ACCOUNT</button>
            </form>

        </div>
    </div>
</div>
</body>
</html>
