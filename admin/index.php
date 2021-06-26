<?php
include('../includes/config.php');
if(!$user->is_logged_in()){
    header('location:login.php');
}

if(isset($_GET['delpost'])){
    $stmt=$db->prepare('DELETE FROM blog WHERE articleId=:articleId');
    $stmt->execute(array(':articleId' => $_GET['delpost']));
    header('location:index.php?action=deleted');
    exit;
}
?>
<?php include("head.php"); ?>
<title>Admin Dashboard</title>
<script type="text/javascript">
    function delpost(id, title) {
        if (confirm("Do you really want to delete '" + title + "'")) {
            window.location.href = 'index.php?delpost=' + id;
        }
    }
</script>
<?php include("header.php")?>
<div class="container pt-4">
    <?php
if (isset($_GET['action'])) {
    echo '<h3>Post'.$_GET['action'].'.</h3>';
}
?>
<div style="overflow-x:auto;">
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Article Title</th>
      <th scope="col">Posted Date</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

<?php
try {
    $stmt=$db->query('SELECT articleId,articleTitle,articleDate FROM blog ORDER BY articleId DESC');
    while($row=$stmt->fetch()){
        echo '<tr><td>'.$row['articleId'].'</td><td>'.$row['articleTitle'].'</td><td>'.date('jS M Y',strtotime($row['articleDate'])).'</td>';
    ?>
        <td>
            <a href="edit-blog-article.php?id=<?php echo $row['articleId'];?>" class="btn btn-info">Edit</a>
        </td>
        <td>
            <a
                href="javascript:delpost('<?php echo $row['articleId'];?>','<?php echo $row['articleTitle'];?>')" class="btn btn-danger">Delete
            </a>
        </td>
        <?php
    echo '</tr>';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
    </tbody>
    </table>
</div>
    <a href="add-blog-article.php" class="btn btn-info">Add New Article</a>
</div>
<?php include("footer.php"); ?>