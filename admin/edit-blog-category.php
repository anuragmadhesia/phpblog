<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
<title>EDIT Category</title>
<?php include("header.php");  ?>

<div class="container pt-4">
    <h2>Edit Category</h2>
    <?php
    //if form has been submitted process it
    if(isset($_POST['submit'])){
        $_POST = array_map( 'stripslashes', $_POST );
        //collect form data
        extract($_POST);
        //very basic validation
        if($categoryId ==''){
            $error[] = 'Invalid id.';
        }
        if($CategoryName ==''){
            $error[] = 'Please enter the Category Title .';
        }
        if(!isset($error)){
            try {
                $categorySlug = slug($CategoryName);
                //insert into database
                $stmt = $db->prepare('UPDATE techno_category SET CategoryName = :CategoryName, categorySlug = :categorySlug WHERE categoryId = :categoryId') ;
                $stmt->execute(array(
                    ':CategoryName' => $CategoryName,
                    ':categorySlug' => $categorySlug,
                    ':categoryId' => $categoryId
                ));
                //redirect to categories  page
                header('Location: blog-categories.php?action=updated');
                exit;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    ?>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo $error.'<br>';
        }
    }
        try {

            $stmt = $db->prepare('SELECT categoryId, CategoryName FROM category WHERE categoryId = :categoryId') ;
            $stmt->execute(array(':categoryId' => $_GET['id']));
            $row = $stmt->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
</form>
<form action="" method="post">
        <input type='hidden' name='categoryId' value='<?php echo $row['categoryId'];?>'>
        <div class="form-group">
            <label>Category Title</label>
            <input type='text' class="form-control" name='categoryName' value='<?php echo $row['CategoryName'];?>'>
        </div>
            <input type="submit" name="submit" class="btn btn-success" value="Update">
    </form>
</div>
<?php include("footer.php");  ?>