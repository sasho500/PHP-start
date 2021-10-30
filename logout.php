<?php
session_start();
session_destroy();
header("Location: http://dev.sashosocial.com/login-form.php");