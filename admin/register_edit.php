<?php
session_start();
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="container-fluid py-5">

    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-blod text-primary">編輯管理者名單
            </h6>
        </div>

        <div class="card-body">

            <?php

            $connction = mysqli_connect('localhost', 'root', '', 'adminpanel');

            if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                $query = "SELECT * FROM register WHERE id='$id'";
                $query_run = mysqli_query($connction, $query);

                foreach ($query_run as $row) {
                    ?>



                    <form action="code.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label>更改用戶名</label>
                            <input type="text" name="edit_username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>更改Email</label>
                            <input type="email" name="edit_Email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>更改密碼</label>
                            <input type="password" name="edit_password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>用戶類型</label>
                            <select name="update_usertype" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>




                        <div align="center">
                            <a href="register.php" class="btn btn-danger">取消更新</a>
                            <button type="submit" name="updatebtn" class="btn btn-primary">確認更新資料</button>
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