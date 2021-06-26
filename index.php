<?php require_once('includes/config.php'); ?>
<?php include("head.php");  ?>
<title>My Blog</title>
<?php include("header.php");  ?>

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-sm-9 bg-secondary">
            <?php
            try {
                //selecting data by id
                $stmt = $db->query('SELECT articleId, articleTitle,articleSlug,articleDescription, articleDate, articleTags  FROM blog ORDER BY articleId DESC');
                while($row = $stmt->fetch()){
                    echo '<div class="card my-3"><div class="card-header">';
                        echo '<h5 class="card-title h3"><a href="'.$row['articleSlug'].'" style="text-decoration:none;">'.$row['articleTitle'].'</a></h5>';
                        if ($row['articleTags']!=null) {
                            echo '<hr/><p><span class="btn btn-secondary btn-sm py-0 px-1 mr-2">Tagged as :- </span>';
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
            <?php include('sidebar.php');?>
    </div>
</div>

<?php include("footer.php");  ?>