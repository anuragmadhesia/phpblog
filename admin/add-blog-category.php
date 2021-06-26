<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
<title>Add New Category</title>
<?php include("header.php");  ?>

<div class="container pt-4">
    <h2>Add Category</h2>
    <?php
    if(isset($_POST['submit'])){
        $_POST = array_map( 'stripslashes', $_POST );
        //collect form data
        extract($_POST);
        if($categoryName ==''){
            $error[] = 'Please enter the Category.';
        }
        if(!isset($error)){
            try {
                $categorySlug = slug($categoryName);
                $stmt = $db->prepare('INSERT INTO category (categoryName,categorySlug) VALUES (:categoryName, :categorySlug)') ;
                $stmt->execute(array(
                    ':categoryName' => $categoryName,
                    ':categorySlug' => $categorySlug
                ));
                header('Location: blog-categories.php?action=added');
                exit;

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="message">'.$error.'</p>';
        }
    }
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label>Category Title</label>
            <input type='text' class="form-control" name='categoryName' value='<?php if(isset($error)){ echo $_POST['categoryName'];}?>'>
        </div>
            <input type="submit" name="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php include("footer.php");  ?>