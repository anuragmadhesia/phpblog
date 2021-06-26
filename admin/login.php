<?php
require_once('../includes/config.php');
if($user->is_logged_in()){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/blog.jpg" type="image/gif" sizes="16x16">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/alert.css">
    <script src="assets/alert.js"></script>
</head>
<body>
    <?php
    if (isset($_POST['submit'])) {

        $username=trim($_POST['username']);
        $password=trim($_POST['password']);

        if($user->login($username,$password)){
            header('location:index.php');
            exit;
        }
        else{
            $message='Invalid Credentials';
        }
    }
    if (isset($message)) {
        echo '<script>alert("'.$message.'");</script>';
    }
    else{
        header('loaction:index.php');
    }
    ?>
    <form action="" method="POST" class="form">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="" autocomplete="off" required/>
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="" required/>
        <br>
        <button type="submit" name="submit">Sign In</button>
    </form>
</body>
</html>
