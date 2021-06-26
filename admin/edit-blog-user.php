<?php
include('../includes/config.php');

if(!$user->is_logged_in()){
    header('location:login.php');
}
?>
<?php include("head.php"); ?>
<title>Edit User Profile</title>
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
            try {
                if(isset($password)){
                    $hashedpassword=$user->create_hash(($password));
                    $stmt=$db->prepare('UPDATE users SET username=:username,password=:password,email=:email WHERE userId=:userId');
                    $stmt->execute(array(':username'=>$username,':password'=>$hashedpassword,':email'=>$email,':userId'=>$userId));
                }
                else{
                    $stmt=$db->prepare('UPDATE users SET username=:username,email=:email WHERE userId=:userId');
                    $stmt->execute(array(':username'=>$username,':email'=>$email,':userId'=>$userId));
                }
                header('Location: blog-users.php?action=updated');
                exit;
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    if (isset($error)) {
        foreach($error as $error){
            echo '<p>'.$error.'</p>';
        }
    }

    try {

        $stmt = $db->prepare('SELECT userId, username, email FROM users WHERE userId = :userId') ;
        $stmt->execute(array(':userId' => $_GET['id']));
        $row = $stmt->fetch();

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    ?>
    <form action="" method="POST" class="pt-5 m-auto" style="max-width: 300px;">
    <input type="hidden" name="userId" value="<?php echo $row['userId'];?>">
        <div class="form-group">
            <label for="exampleInput">Username</label>
            <input type="text" class="form-control" name="username" id="exampleInput" value="<?php echo $row['username'];?>" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password (only to change)</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" value="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email'];?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>
<?php include("footer.php"); ?>