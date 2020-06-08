<?php
include('security.php');
include('./includes/header.php');
include('./includes/navbar.php');

?>

<div class="container-fluid py-5">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">作家介紹</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['edit_data_btn'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM clien WHERE id='$id'";
                $query_run = mysqli_query($connction, $query);

                foreach ($query_run as $row) {
                    ?>


                    <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label>編輯姓名</label>
                            <input type="text" name="edit_name" class="form-control" value="<?php echo $row['name']?>" />
                        </div>
                        <div class="form-group">
                            <label>編輯描述</label>
                            <input type="text" name="edit_description" class="form-control" value="<?php echo $row['descrip']?>" />
                        </div>
                        <div class="form-group">
                            <label>更換頭貼</label>
                            <input type="file" name="clien_image" id="clien_image" value="<?php echo $row['image']?>"/>
                        </div>

                        <div align="center">
                            <a href="clien.php" class="btn btn-danger">取消更新</a>
                            <button type="submit" name="clien_update_btn" class="btn btn-primary">確認更新資料</button>
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