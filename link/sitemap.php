<?php
require('../includes/config.php');
$pages = $db->query('SELECT pageSlug FROM pages ORDER BY pageId ASC');
$article = $db->query('SELECT articleSlug FROM blog ORDER BY articleId ASC');
$category = $db->query('SELECT categorySlug FROM category ORDER BY categoryId ASC');
$tag= $db->query('SELECT articleTags FROM blog ORDER BY articleId ASC');
$base_url = "http://localhost:8080/blog/";
//Page base URL
$page_base_url = "http://localhost:8080/blog/page/";
//Category base URL
$category_base_url = "http://localhost:8080/blog/category/";
//tag base URL
$tag_base_url = "http://localhost:8080/blog/tag/";
header("Content-Type: application/xml; charset=utf-8");

echo '<!--?xml version="1.0" encoding="UTF-8"?-->'.PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemalocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;


while($row = $pages->fetch()){

 echo '<url>' . PHP_EOL;
 echo '<loc>'.$page_base_url. $row["pageSlug"] .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}


 while($row = $article->fetch()){

 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url. $row["articleSlug"] .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}
while($row = $category->fetch()){

 echo '<url>' . PHP_EOL;
 echo '<loc>'.$category_base_url. $row["categorySlug"] .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}
while($row = $tag->fetch()){

 echo '<url>' . PHP_EOL;
 echo '<loc>'.$tag_base_url. $row["articleTags"] .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

$tagsArray = [];
$stmt = $db->query('select distinct LOWER(articleTags) as articleTags from blog where articleTags != "" group by articleTags');
while($row = $stmt->fetch()){
    $parts = explode(',', $row['articleTags']);
    foreach ($parts as $tag) {
        $tagsArray[] = $tag;
    }
}
$finalTags = array_unique($tagsArray);
foreach ($finalTags as $tag) {
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$tag_base_url.$tag.'</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>