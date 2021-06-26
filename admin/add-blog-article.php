<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>

<?php include("head.php");  ?>
<!-- On page head area-->
<title>Add Article</title>
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

<?php include("header.php");?>

<div class="container" style="max-width: 800px;">
    <?php
    //if form has been submitted process it
    if(isset($_POST['submit'])){
        //collect form data
        extract($_POST);
        //very basic validations
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
                $articleSlug = slug($articleTitle);
                //insert into database
                $stmt = $db->prepare('INSERT INTO blog (articleTitle,articleSlug,articleDescription,articleContent,articleDate,articleTags) VALUES (:articleTitle, :articleSlug, :articleDescription, :articleContent, :articleDate, :articleTags)') ;
                $stmt->execute(array(
                    ':articleTitle' => $articleTitle,
                    ':articleSlug' => $articleSlug,//Blog article slug
                    ':articleDescription' => $articleDescription,
                    ':articleContent' => $articleContent,
                    ':articleDate' => date('Y-m-d H:i:s'),
                    ':articleTags' => $articleTags
                ));
                //add categories
                $articleId = $db->lastInsertId();
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
                header('Location: index.php?action=added');
                exit;
            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="message">'.$error.'</p>';
        }
    }
    ?>
    <h1 class="pt-3 m-auto">Add New Article</h1>
    <form action="" method="post" class="pt-3 m-auto">

        <div class="form-group">
            <label for="title">Article Title</label>
            <input type="text" id="title" class="form-control" name="articleTitle"
                value="<?php if(isset($error)){ echo $_POST['articleTitle'];}?>" required>
        </div>

        <div class="form-group">
            <label for="description">Short Description(Meta Description) </label>
            <textarea name="articleDescription" class="form-control" id="description" rows="3"
                required><?php if(isset($error)){ echo $_POST['articleDescription'];}?></textarea>
        </div>

        <div class="form-group">
            <label for="basic-example">Long Description(Body Content)</label>
            <textarea name="articleContent" class="form-control" id="basic-example"
                rows='10'><?php if(isset($error)){ echo $_POST['articleContent'];}?></textarea>
        </div>

        <fieldset class="my-4 bg-light p-3 border border-dark">
                <legend>Categories</legend>
                <?php
                    $checked = null;
                    $stmt2 = $db->query('SELECT categoryId, categoryName FROM category ORDER BY categoryName');
                    while($row2 = $stmt2->fetch()){
                        if(isset($_POST['categoryId'])){
                            if(in_array($row2['categoryId'], $_POST['categoryId'])){
                            $checked="checked='checked'";
                            }
                        }
                        echo "<input type='checkbox' name='categoryId[]' value='".$row2['categoryId']."' $checked> ".$row2['categoryName']."<br />";
                    }
                ?>
        </fieldset>
        <div class="form-group">
            <label>Articles Tags (Separated by comma without space)</label>
            <input type='text'  name='articleTags' class="form-control border border-dark" value='<?php if(isset($error)){ echo $_POST['articleTags'];}?>'>
        </div>
        <button type="submit" name="submit" class="btn btn-success mb-5">ADD</button>

    </form>

</div>

<?php include('footer.php');  ?>