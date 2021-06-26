<?php
include('../includes/config.php');

if(!$user->is_logged_in()){
    header('location:login.php');
}
?>
<?php include("head.php"); ?>
<title>Add Users</title>
<?php include("header.php"); ?>
<div class="container">
    <?php
    if (isset($_POST['submit'])) {
        extract($_POST);
        //validation
        if ($username=='') {
            $error[]='Please enter the username';
        }
        if (strlen($password)>0) {
            if ($password=='') {
                $error[]='Please enter the password';
            }
            if ($cpassword=='') {
                $error[]='Please confirm the password';
            }
            if ($password!=$cpassword) {
                $error[]='Please do not match';
            }
        }
        if ($email=='') {
            $error[]='Please enter the Email';
        }
        if (!isset($error)) {
            $hashedpassword=$user->create_hash(($password));
            try {
                $stmt=$db->prepare('INSERT INTO users(username,password,email) VALUES(:username,:password,:email)');
                $stmt->execute(array(':username'=>$username,':password'=>$hashedpassword,':email'=>$email));
                header('Location: blog-users.php?action=added');
                exit;
            } catch (PDOException $th) {
                echo $e->getMessage();
            }
        }
    }
    if (isset($error)) {
        foreach($error as $error){
            echo '<p>'.$error.'</p>';
        }
    }
    ?>
    <form action="" method="POST" class="pt-5 m-auto" style="max-width: 300px;">
        <div class="form-group">
            <label for="exampleInput">Username</label>
            <input type="text" class="form-control" name="username" id="exampleInput" value="<?php if (isset($error)) {echo $_POST['username'];}?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="<?php if (isset($error)) {echo $_POST['password'];}?>" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" value="<?php if (isset($error)) {echo $_POST['cpassword'];}?>" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if (isset($error)) {echo $_POST['email'];}?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<?php include("footer.php"); ?>