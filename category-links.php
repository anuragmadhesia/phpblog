<?php require('includes/config.php');
$stmt = $db->prepare('SELECT categoryId,categoryName FROM category WHERE categorySlug = :categorySlug');
$stmt->execute(array(':categorySlug' => $_GET['id']));
$row = $stmt->fetch();
//if post does not exists redirect user.
if($row['categoryId'] == ''){
    header('Location: ./');
    exit;
}
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
<title><?php echo $row['categoryName'];?></title>
<?php include("header.php");  ?>
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-sm-9">
    <h4>Article Category:- <?php echo $row['categoryName'];?></h4>
    <hr>
    <?php
        try {
            $stmt = $db->prepare('
                SELECT
                    blog.articleId, blog.articleTitle, blog.articleSlug, blog.articleDescription, blog.articleDate,blog.articleTags
                FROM
                    blog,
                    cat_links
                WHERE
                    blog.articleId =  cat_links.articleId
                    AND  cat_links.categoryId = :categoryId
                ORDER BY
                    articleId DESC
            ');
            $stmt->execute(array(':categoryId' => $row['categoryId']));
            while($row = $stmt->fetch()){
                echo '<div class="card my-3"><div class="card-header">';
                    echo '<h5 class="card-title"><a href="../'.$row['articleSlug'].'" style="text-decoration:none;">'.$row['articleTitle'].'</a></h5>';
                    if ($row['articleTags']!=null) {
                        echo '<hr/><p><span class="btn btn-secondary btn-sm py-0 px-1 mr-2">Tagged as :- </span>';
                        $links = array();
                        $parts = explode(',', $row['articleTags']);
                        foreach ($parts as $tags)
                        {
                            $links[] = "<a href='../tag/".$tags."' class='btn btn-secondary btn-sm py-0 px-1 mr-2'>".$tags."</a>";
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
                                $links[] = "<a href='".$cat['categorySlug']."' class='p-1'>".$cat['categoryName']."</a>";
                            }
                            echo implode(", ", $links);
                        }
                        else{
                            echo '</span>';
                        }
                    echo '</div>';
                    if (strlen($row['articleDescription'])>300) {
                        echo '<div class="card-body"><p class="card-text">'.substr($row['articleDescription'],0,300).'...</p>';
                    }
                    else{
                        echo '<div class="card-body"><p class="card-text">'.$row['articleDescription'].'</p>';
                    }
                    echo '<a href="'.$row['articleSlug'].'" class="btn btn-primary">Read More</a>';
                echo '</div></div>';
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        ?>
</div>
<?php include("sidebar.php");  ?>
</div>
</div>

<footer class="page-footer font-small bg-dark mt-auto"><!-- mt-auto to make footer to bottom -->

  <div class="text-center py-3 mt-0 ">
    <a href="https://anuragmadhesia.com/" class="text-decoration-none text-warning">Built with 💛 By Anurag Madhesia</a>
  </div>

</footer>
<!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>