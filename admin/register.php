<?php

include('security.php');
include('./includes/header.php');
include('./includes/navbar.php');


?>

<div class="container-fluid py-3">
    <?php include('./includes/Topbar.php'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-blod text-primary">管理者名單
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">新增管理員 </button>
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

                $query = "SELECT * FROM register";
                $query_run = mysqli_query($connction, $query);

                ?>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>序號</th>
                            <th>使用者</th>
                            <th>Email</th>
                            <th>密碼</th>
                            <th>用戶類型</th>
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
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['usertype']; ?></td>
                                    <td>
                                        <form action="register_edit.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-success">編輯</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger">刪除</button>
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


        </div>

    </div>

    <?php include('./includes/footer.php'); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>用戶名</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control check_email" placeholder="Email" required="required" />
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>密碼</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="required" />
                    </div>
                    <div class="form-group">
                        <label>密碼確認</label>
                        <input type="password" name="confirmpassword" class="form-control" placeholder="confirmpassword">
                    </div>

                        <input type="hidden" name="usertype" value="admin">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="registerbtn">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>



<?php

include('./includes/scripts.php');



?>