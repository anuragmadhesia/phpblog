<?php
require_once('../includes/config.php');
//check login or not
if(!$user->is_logged_in()){ header('Location: login.php'); }

if(isset($_GET['delpost'])){

    $stmt = $db->prepare('DELETE FROM techno_pages WHERE pageId = :pageId') ;
    $stmt->execute(array(':pageId' => $_GET['delpost']));

    header('Location: blog-pages.php?action=deleted');
    exit;
}
?>
<?php include("head.php");  ?>
<title>Admin Page </title>
<script language="JavaScript" type="text/javascript">
function delpost(id, title) {
    if (confirm("Are you sure you want to delete '" + title + "'")) {
        window.location.href = 'blog-pages.php?delpost=' + pageId;
    }
}
</script>
<?php include("header.php");  ?>

<div class="container pt-4">
    <?php
    //show message from add / edit page
    if(isset($_GET['action'])){
        echo '<h3>Post '.$_GET['action'].'.</h3>';
    }
    ?>

<div style="overflow-x:auto;">
        <table class="table table-striped  table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id No.</th>
                    <th scope="col">Article Title</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
        <?php
        try {

            $stmt = $db->query('SELECT pageId,pageTitle,pageDescription,pageContent,pageKeywords FROM pages ORDER BY pageId DESC');
            while($row = $stmt->fetch()){
                echo '<tr>';
                echo '<td>'.$row['pageId'].'</td>';
                echo '<td>'.$row['pageTitle'].'</td>';
                ?>

                <td>
                    <a href="edit-blog-page.php?pageId=<?php echo $row['pageId'];?>"class="btn btn-info">Edit</a>
                </td>
                <td>
                    <a href="javascript:delpost('<?php echo $row['pageId'];?>','<?php echo $row['pageTitle'];?>')" class="btn btn-danger">Delete</a>
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
</div>

    <a href='add-blog-page.php' class="btn btn-info">Add New Page</a>
</div>
<?php include("footer.php");  ?>