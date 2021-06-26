<?php
include('../includes/config.php');

if(!$user->is_logged_in()){
    header('location:login.php');
}

if(isset($_GET['deluser'])){
    if($_GET['deluser']!=1){
        $stmt=$db->prepare('DELETE FROM users WHERE userId=:userId');
        $stmt->execute(array(':userId' => $_GET['deluser']));
        header('location:blog-users.php?action=deleted');
        exit;
    }
}
?>
<?php include("head.php"); ?>
<title>Blog Users</title>
<script type="text/javascript">
function deluser(id, title) {
    if (confirm("Are you sure want to delete '" + title + "'")) {
        window.location.href = 'blog-users.php?deluser=' + id;
    }
}
</script>
<?php include("header.php")?>
<div class="container mt-5">
    <?php
if (isset($_GET['action'])) {
    echo '<h3>Post'.$_GET['action'].'.</h3>';
}
?>
    <div style="overflow-x:auto;">
        <table class="table table-striped  table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id No.</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php
                try {
                    $stmt=$db->query('SELECT userId,username,email FROM users ORDER BY userId');
                    while($row=$stmt->fetch()){
                                echo '<tr><td>'.$row['userId'].'</td><td>'.$row['username'].'</td><td>'.$row['email'].'</td>';
                            ?>
                        <td>
                            <a href="edit-blog-user.php?id=<?php echo $row['userId'];?>" class="btn btn-info">Edit</a>
                            <?php if ($row['userId']!=1) {?>
                        </td>
                        <td>
                            <a href="javascript:deluser('<?php echo $row['userId'];?>','<?php echo $row['username'];?>')" class="btn btn-danger">Delete</a>
                            <?php }?>
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
    <a href="add-blog-user.php" class="btn btn-info">Add Blog User</a>
</div>
<?php include("footer.php"); ?>