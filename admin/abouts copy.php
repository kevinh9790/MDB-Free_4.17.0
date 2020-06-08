<?php

include('security.php');
include('./includes/header.php');
include('./includes/navbar.php');


?>

<div class="container-fluid py-3">
    <?php include('./includes/Topbar.php'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-blod text-primary">關於我們
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">新增內容 </button>
            </h6>
        </div>

        <div class="card-body">

            <?php


            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {

                echo '<div class="alert-success"> ' . $_SESSION['success'] . ' </div>';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {

                echo '<div class="alert-danger"> ' . $_SESSION['status'] . ' </div>';
                unset($_SESSION['status']);
            }

            ?>

            <div class="table-responsive">

                <?php
                $connction = mysqli_connect('localhost', 'root', '', 'adminpanel');

                $query = "SELECT * FROM abouts";
                $query_run = mysqli_query($connction, $query);

                ?>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>序號</th>
                            <th>標題</th>
                            <th>子標題</th>
                            <th>描述</th>
                            <th>貼文封面</th>
                            <th>編輯</th>
                            <th>刪除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['subtitle']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo '<img src="upload/'. $row['image'].'" alt="image" width="100px;" height="100px;">'?></td>
                                    <td>
                                        <form action="about_edit.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-success">編輯</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="about_delete_btn" class="btn btn-danger">刪除</button>
                                        </form>

                                    </td>

                                </tr>



                        <?php
                            }
                        } else {
                            echo "沒有內容";
                        }

                        ?>

                    </tbody>

                </table>




            </div>

            <div align="center">
                        <a href="../abouts.php" class="btn btn-primary">瀏覽貼文</a>
                    </div>
        </div>

    </div>

    <?php include('./includes/footer.php'); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新增貼文內容</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>標題</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title" required="required" />
                    </div>
                    <div class="form-group">
                        <label>子標題</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="Enter Sub title" required="required" />
                    </div>
                    <div class="form-group">
                        <label>描述</label>
                        <textarea id="address" class="form-control" name="description" rows="2" cols="40" placeholder="description" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label>貼文封面</label>
                        <input type="file" name="clien_image" id="clien_image" class="form-control" required="required" />
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="about_save">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>



<?php

include('./includes/scripts.php');



?>