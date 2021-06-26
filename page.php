<?php require('includes/config.php');
$stmt = $db->prepare('SELECT pageId,pageTitle,pageSlug,pageContent,pageDescription,pageKeywords FROM pages WHERE pageSlug = :pageSlug');
$stmt->execute(array(':pageSlug' => $_GET['pageId']));
$row = $stmt->fetch();
//if post does not exists redirect user.
if($row['pageId'] == ''){
    header('Location: ./');
    exit;
}
$baseUrl="http://localhost:8080/blog/";
$slug=$row['pageSlug'];
$pageIdc=$row['pageId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" href="../assets/blog.jpg" type="image/gif" sizes="16x16">
    <title><?php echo $row['pageTitle'];?></title>
    <meta property="og:title" content="<?php echo $row['pageTitle'];?>">
    <meta property="og:type" content="article">
    <meta name="description" property="og:type" content="<?php echo $row['pageDescription'];?>">
    <meta property="og:url" content="<?php echo $baseUrl.$slug; ?>">
    <meta property="og:image" content="<?php echo $baseUrl.'../assets/blog.jpg'; ?>">
    <meta name="keywords" content="<?php echo $row['pageKeywords'];?>">
    <style>
    #show{
        padding: 0 50px;
        background: #fff;
        min-height: 100%;
    }
    #show span{
        font-size: 40px;
        font-weight: 500;
    }
    #show hr{
        border: 1px solid gray;
    }
    @media  screen and (max-width:768px) {
        #show span{
        font-size: 28px;
        font-weight: 500;
        }
        #show{
            background: none;
            padding: 0px;
        }
    }
    </style>

<?php include("header.php");  ?>
<div class="container-fluid p-4 mb-3 h-100">

    <?php
    echo '<div id="show" class="my-3 rounded pt-3">';
        echo '<h1>'.$row['pageTitle'].'</h1>';
        ?>
        <hr>
        <?php
        echo '<p>'.$row['pageContent'].'</p>';
    echo '</div>';
    ?>

</div>

<?php include("footer.php");  ?>