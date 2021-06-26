<?php require('includes/config.php');
$stmt = $db->prepare('SELECT articleId,articleDescription,articleTitle,articleSlug,articleContent,articleDate,articleTags FROM blog WHERE articleSlug = :articleSlug');
$stmt->execute(array(':articleSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['articleId'] == ''){
    header('Location: ./');
    exit;
}
$baseUrl="http://localhost:8080/blog/";
$slug=$row['articleSlug'];
$articleIdc=$row['articleId'];
?>
<?php include("head.php");  ?>
<meta property="og:title" content="<?php echo $row['articleTitle'];?>">
<meta property="og:type" content="article">
<meta name="description" property="og:description" content="<?php echo $row['articleDescription'];?>">
<meta property="og:url" content="<?php echo $baseUrl.$slug; ?>">
<meta property="og:image" content="<?php echo $baseUrl.'assets/blog.jpg'; ?>">
<title><?php echo $row['articleTitle'];?></title>
<meta name="description" content="<?php echo $row['articleDescription'];?>">
<meta name="keywords" content="Article Keywords">
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
<div class="container-fluid p-4 mb-3">
    <div class="row">
        <div class="col-sm-9">
        <?php
            echo '<div id="show" class="my-3 rounded pt-3">';
                echo '<span>'.$row['articleTitle'].'</span><hr/>';
                if ($row['articleTags']!=null) {
                    echo '<p><h class="btn btn-secondary btn-sm py-0 px-1 mr-2">Tagged as :- </h>';
                    $links = array();
                    $parts = explode(',', $row['articleTags']);
                    foreach ($parts as $tags)
                    {
                        $links[] = "<a href='tag/".$tags."' class='btn btn-secondary btn-sm py-0 px-1 mr-2'>".$tags."</a>";
                    }
                    echo implode("", $links);
                    echo '</p>';
                }
                echo '<span style="font-size: 12px;">Posted on '.date('jS M Y', strtotime($row['articleDate'])).' ';

                    $stmt2 = $db->prepare('SELECT categoryName, categorySlug   FROM category, cat_links WHERE category.categoryId = cat_links.categoryId AND cat_links.articleId = :articleId');
                    $stmt2->execute(array(':articleId' => $row['articleId']));
                    $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    $links = array();
                    if ($catRow!=null) {
                        echo 'in category   </span>';
                        foreach ($catRow as $cat){
                            $links[] = "<a href='category/".$cat['categorySlug']."' class='p-1'>".$cat['categoryName']."</a>";
                        }
                        echo implode(", ", $links);
                    }
                    else{
                        echo '</span>';
                    }
                echo '<p>'.$row['articleContent'].'</p>';
                ?>
                <h4 class="pt-4">Please Share</h4>
                <a target="_blank" class="btn px-3 py-1 btn-primary" href="https://www.facebook.com/sharer.php?u=<?php echo $baseUrl.$slug; ?>"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="btn px-3 py-1 btn-success" href="https://api.whatsapp.com/send?text=<?php echo $baseUrl.$slug; ?>"><i class="fab fa-whatsapp"></i></a>
                <a target="_blank" class="btn px-3 py-1 btn-info" href="https://twitter.com/share?text=Visit the link &url=<?php echo $baseUrl.$slug; ?>&hashtags=blog,anuragmadhesia,programming,tutorials,codes,examples,language,development"><i class="fab fa-twitter"></i></a>
                <a target="_blank" class="btn px-3 py-1 btn-danger" href="https://pinterest.com/pin/create/button/?url=<?php echo $baseUrl.$slug; ?>"><i class="fab fa-pinterest-p"></i></a>
                <?php
                    // run query//select by current id and display the next 5 blog posts
                    $recom= $db->query("SELECT * from blog where articleId>$articleIdc order by articleId ASC limit 5");
                    if ($recom->rowCount() > 0) {
                        echo '<h3 class="pt-5"> Recomended Posts:</h3>
                        <div class="px-3 pt-2">';
                        // look through query
                        while($row1 = $recom->fetch()){
                            echo '<a href="'.$row1['articleSlug'].'">'.$row1['articleTitle'].'</a><hr style="border: 1px dashed grey;"/>';
                        }
                        echo '</div>';
                    }

                    // run query//select by current id and display the next 5 blog posts
                    $recom= $db->query("SELECT * from blog where articleId<$articleIdc order by articleId ASC limit 5");
                    if ($recom->rowCount() > 0) {
                        echo '<h3 class="pt-5"> Previous Posts:</h3>
                        <div class="px-3 pt-2">';
                        // look through query
                        while($row1 = $recom->fetch()){
                            echo '<a href="'.$row1['articleSlug'].'">'.$row1['articleTitle'].'</a><hr style="border: 1px dashed grey;"/>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                ?>
        </div>
        <?php include('sidebar.php');?>
    </div>
</div>
<?php include("footer.php");  ?>