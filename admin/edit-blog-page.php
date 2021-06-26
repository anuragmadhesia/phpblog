<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
<title>Update Page</title>
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
<?php


if(isset($_POST['submit'])){
    //collect form data
    extract($_POST);
    //very basic validation
    if($pageId ==''){
        $error[] = 'Invalid ID .';
    }
    if($pageTitle ==''){
            $error[] = 'Please enter the Page title.';
    }
    if($pageDescription ==''){
        $error[] = 'Please enter the Page description.';
    }
    if($pageContent ==''){
        $error[] = 'Please enter the content.';
    }
    if($pageKeywords ==''){
        $error[] = 'Please enter the Article Keywords.';
    }
    if(!isset($error)){
        try {
            $pageSlug = slug($pageTitle);
            //insert into database
            $stmt = $db->prepare('UPDATE pages SET pageTitle = :pageTitle, pageSlug = :pageSlug, pageDescription = :pageDescription, pageContent = :pageContent, pageKeywords = :pageKeywords WHERE pageId = :pageId') ;
            $stmt->execute(array(
                ':pageTitle' => $pageTitle,
                ':pageSlug' => $pageSlug,
                ':pageDescription' => $pageDescription,
                ':pageContent' => $pageContent,
                ':pageId' => $pageId,
                ':pageKeywords' => $pageKeywords
            ));
            //redirect to index page
            header('Location: blog-pages.php?action=updated');
            exit;
        } catch(PDOException $e) {
        echo $e->getMessage();
        }

    }

}

?>
<?php
//check for any errors
if(isset($error)){
    foreach($error as $error){
        echo $error.'<br>';
    }
}
try {
    $stmt = $db->prepare('SELECT pageId, pageSlug,pageTitle, pageDescription, pageContent, pageKeywords FROM pages WHERE pageId = :pageId') ;
    $stmt->execute(array(':pageId' => $_GET['pageId']));
    $row = $stmt->fetch();
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<h1 class="pt-3 m-auto">Edit Page</h1>
<form action="" method="post" class="pt-3 m-auto">
<input type='hidden' name='pageId' value='<?php echo $row['pageId'];?>'>
    <div class="form-group">
        <label for="title">Page Title</label>
        <input type="text" id="title" class="form-control" name="pageTitle" value="<?php echo $row['pageTitle'];?>" required>
    </div>

    <div class="form-group">
        <label for="description">Short Description(Meta Description) </label>
        <textarea name="pageDescription" class="form-control" id="description" rows="3"
            required><?php echo $row['pageDescription'];?></textarea>
    </div>

    <div class="form-group">
        <label for="basic-example">Long Description(Body Content)</label>
        <textarea name="pageContent" class="form-control" id="basic-example"
            rows='10'><?php echo $row['pageContent'];?></textarea>
    </div>

    <div class="form-group">
        <label for="keywords">Page Keywords (Seprated by comma without space)</label>
        <input type="text" id="keywords" class="form-control border border-dark" name="pageKeywords" value="<?php echo $row['pageKeywords'];?>" required>
    </div>

    <button type="submit" name="submit" class="btn btn-success mb-5">SUBMIT</button>

</form>
</div>

<?php include("footer.php");  ?>