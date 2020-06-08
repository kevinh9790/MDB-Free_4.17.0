<?php
session_start();
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="container-fluid py-5">

    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-blod text-primary">關於我們貼文編輯
            </h6>
        </div>

        <div class="card-body">

            <?php

            $connction = mysqli_connect('localhost', 'root', '', 'adminpanel');

            if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM abouts WHERE id='$id'";
                $query_run = mysqli_query($connction, $query);

                foreach ($query_run as $row) {
                    ?>
                    <form action="code.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <label>標題</label>
                            <input type="text" name="edit_title" class="form-control" value="<?php echo $row['title'] ?>" required="required" />
                        </div>
                        <div class="form-group">
                            <label>子標題</label>
                            <input type="text" name="edit_subtitle" class="form-control" value="<?php echo $row['subtitle'] ?>" required="required" />
                        </div>
                        <div class="form-group">
                            <label>描述</label>
                            <input type="text" name="edit_description" class="form-control" value="<?php echo $row['description']?>" required="required" />
                           
                        </div>
                        <div class="form-group">
                            <label>更改圖片</label>
                            <input type="file" name="edit_image" class="form-control" value="<?php echo $row['links'] ?>">
                        </div>

                        <div align="center" class="py-3">
                         <a href="abouts.php" class="btn btn-danger">取消更新</a>
                            <button type="submit" class="btn btn-primary" name="about_update">Save changes</button>
                        </div>
                    </form>

            <?php
                }
            }
            ?>


        </div>
    </div>
    <?php include('./includes/footer.php'); ?>
</div>





<?php

include('./includes/scripts.php');



?>