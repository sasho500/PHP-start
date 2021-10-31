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
        <?php if (array_key_exists("error", $_GET)) { ?>
            <p class="error"><?php echo $_GET['error'] ?></p>

        <?php } else if (array_key_exists("success", $_GET)) { ?>
            <p class="success"><?php echo $_GET['success'] ?></p>
        <?php } ?>

        <form action="register-form-save.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password </label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <button type="reset" class="btn btn-warning">RESET</button>
            <button type="button" class="btn btn-danger">DONT SUBMIT</button>
            <button class="btn btn-primary">Save</button>
        </form>

        <a href="login-form.php">Login</a>
    </div>
</div>


</body>
</html>