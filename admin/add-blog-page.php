<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<?php include("head.php");  ?>
<!-- On page head area-->
<title>Add New Page</title>
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
            $error[] = 'Please enter the Page Keywords.';
        }

        if(!isset($error)){
        try {
            $pageSlug = slug($pageTitle);
            //insert into database
            $stmt = $db->prepare('INSERT INTO pages (pageTitle,pageSlug,pageDescription,pageContent,pageKeywords) VALUES (:pageTitle, :pageSlug, :pageDescription, :pageContent,:pageKeywords)') ;
            $stmt->execute(array(
                ':pageTitle' => $pageTitle,
                ':pageSlug' => $pageSlug,
                ':pageDescription' => $pageDescription,
                ':pageContent' => $pageContent,
                ':pageKeywords' => $pageKeywords
            ));
            //redirect to index page
            header('Location: blog-pages.php?action=added');
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
<h1 class="pt-3 m-auto">Add New Page</h1>
<form action="" method="post" class="pt-3 m-auto">

    <div class="form-group">
        <label for="title">Page Title</label>
        <input type="text" id="title" class="form-control" name="pageTitle" value="<?php if(isset($error)){ echo $_POST['pageTitle'];}?>" required>
    </div>

    <div class="form-group">
        <label for="description">Short Description(Meta Description) </label>
        <textarea name="pageDescription" class="form-control" id="description" rows="3"
            required><?php if(isset($error)){ echo $_POST['pageDescription'];}?></textarea>
    </div>

    <div class="form-group">
        <label for="basic-example">Long Description(Body Content)</label>
        <textarea name="pageContent" class="form-control" id="basic-example"
            rows='10'><?php if(isset($error)){ echo $_POST['pageContent'];}?></textarea>
    </div>

    <div class="form-group">
        <label for="keywords">Page Keywords (Seprated by comma without space)</label>
        <input type="text" id="keywords" class="form-control border border-dark" name="pageKeywords" value="<?php if(isset($error)){ echo $_POST['pageKeywords'];}?>" required>
    </div>

    <button type="submit" name="submit" class="btn btn-success mb-5">SUBMIT</button>

</form>
</div>
<?php include("footer.php");  ?>