<?php require_once('../includes/config.php');

if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
<title>Edit Article</title>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: 'textarea#basic-example',
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount', 'image code', 'autoresize'
    ],
    toolbar: 'undo redo | link image | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
<?php include("header.php");  ?>

<div class="container" style="max-width: 800px;">

    <h1 class="pt-3 m-auto">Edit Post</h1>
    <?php

    if(isset($_POST['submit'])){
        //collect form data
        extract($_POST);

        //very basic validation
        if($articleId ==''){
            $error[] = 'This post is missing a valid id!.';
        }

        if($articleTitle ==''){
            $error[] = 'Please enter the title.';
        }

        if($articleDescription ==''){
            $error[] = 'Please enter the description.';
        }

        if($articleContent ==''){
            $error[] = 'Please enter the content.';
        }


        if(!isset($error)){
try {

    //insert into database
    $stmt = $db->prepare('UPDATE blog SET articleTitle = :articleTitle, articleSlug = :articleSlug,  articleDescription = :articleDescription, articleContent = :articleContent,articleTags = :articleTags WHERE articleId = :articleId') ;
    $stmt->execute(array(
        ':articleTitle' => $articleTitle,
        ':articleSlug' => $articleSlug,
        ':articleDescription' => $articleDescription,
        ':articleContent' => $articleContent,
        ':articleTags' => $articleTags,
        ':articleId' => $articleId,
    ));
    $stmt = $db->prepare('DELETE FROM cat_links WHERE articleId = :articleId');
    $stmt->execute(array(':articleId' => $articleId));
    if(is_array($categoryId)){
        foreach($_POST['categoryId'] as $categoryId){
            $stmt = $db->prepare('INSERT INTO cat_links (articleId,categoryId)VALUES(:articleId,:categoryId)');
            $stmt->execute(array(
                ':articleId' => $articleId,
                ':categoryId' => $categoryId
            ));
        }
    }
    //redirect to index page
    header('Location: index.php?action=updated');
    exit;

} catch(PDOException $e) {
    echo $e->getMessage();
}

}

    }

    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo $error.'<br>';
        }
    }

        try {

           $stmt = $db->prepare('SELECT articleId,articleTitle,articleSlug,articleDescription,articleContent,articleTags FROM blog WHERE articleId = :articleId') ;
            $stmt->execute(array(':articleId' => $_GET['id']));
            $row = $stmt->fetch();

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    ?>
    <form action="" method="post" class="pt-3 m-auto">
        <input type='hidden' name='articleId' value="<?php echo $row['articleId'];?>">
        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" id="title" class="form-control" name="articleTitle" value="<?php echo $row['articleTitle'];?>" required>
        </div>

        <div class="form-group">
            <label for="slug">Article Slug</label>
            <input type="text" id="slug" class="form-control" name="articleSlug" value="<?php echo $row['articleSlug'];?>" required>
        </div>

        <div class="form-group">
            <label for="description">Short Description(Meta Description) </label>
            <textarea name="articleDescription" class="form-control" id="description" rows="3" required><?php echo $row['articleDescription'];?></textarea>
        </div>

        <div class="form-group">
            <label for="basic-example">Long Description(Body Content)</label>
            <textarea name="articleContent" class="form-control" id="basic-example" rows='10'><?php echo $row['articleContent'];?></textarea>
        </div>

        <fieldset class="my-4 bg-light p-3 border border-dark">
            <legend>Categories</legend>
            <?php
            $stmt2 = $db->query('SELECT categoryId, categoryName FROM category ORDER BY categoryName');
            while($row2 = $stmt2->fetch()){

                $stmt3 = $db->prepare('SELECT categoryId FROM cat_links WHERE categoryId = :categoryId AND articleId = :articleId') ;
                $stmt3->execute(array(':categoryId' => $row2['categoryId'], ':articleId' => $row['articleId']));
                $row3 = $stmt3->fetch();
                $checked = '';
                if(isset($row3['categoryId']) == $row2['categoryId']){
                    $checked = 'checked';
                }
                echo "<input type='checkbox' name='categoryId[]' value='".$row2['categoryId']."' ".$checked."> ".$row2['categoryName']."<br />";
            }
            ?>
       </fieldset>
       <div class="form-group">
            <label>Articles Tags (Separated by comma without space)</label>
            <input type='text'  name='articleTags' class="form-control border border-dark" value='<?php echo $row['articleTags'];?>'>
        </div>
        <button type="submit" name="submit" class="btn btn-success mb-5">UPDATE</button>
    </form>

</div>
<?php include("footer.php");  ?>