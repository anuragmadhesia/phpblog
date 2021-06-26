<?php require_once('../includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
//show message from add / edit page
if(isset($_GET['delcat'])){
    $stmt = $db->prepare('DELETE FROM category WHERE categoryId = :categoryId') ;
    $stmt->execute(array(':categoryId' => $_GET['delcat']));
    header('Location: blog-categories.php?action=deleted');
    exit;
}
?>
<?php include("head.php");  ?>
<title>Categories</title>
<script type="text/javascript">
function delcat(id, title) {
    if (confirm("Are you sure you want to delete '" + title + "'")) {
        window.location.href = 'blog-categories.php?delcat=' + id;
    }
}
</script>
<?php include("header.php");  ?>

<div class="container pt-4">
    <?php
    //show message from add / edit page
    if(isset($_GET['action'])){
        echo '<h3>Category '.$_GET['action'].'.</h3>';
    }
    ?>
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            $stmt = $db->query('SELECT categoryId, categoryName, categorySlug FROM category ORDER BY categoryName DESC');
            while($row = $stmt->fetch()){
                echo '<tr>';
                echo '<td>'.$row['categoryName'].'</td>';
                ?>
                <td>
                    <a href="edit-blog-category.php?id=<?php echo $row['categoryId'];?>"class="btn btn-info mx-3">Edit</a>
                    <a href="javascript:delcat('<?php echo $row['categoryId'];?>','<?php echo $row['categorySlug'];?>')" class="btn btn-danger">Delete</a>
                </td>
        <?php
                echo '</tr>';

            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
    </tbody>
    </table>

    <a href='add-blog-category.php' class="btn btn-success">Add New Category</a>
</div>
<?php include("footer.php");  ?>