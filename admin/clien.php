<?php
include('security.php');
include('./includes/header.php');
include('./includes/navbar.php');

?>

<div class="container-fluid py-3">
    <?php include('./includes/Topbar.php'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="code.php" method="POST">
                <button type="submit" name="delete_muliple_data" class="btn btn-danger">刪除多筆資料</button>
            </form>
            <h6 class="m-0 font-weight-blod text-primary">人員資料
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


                $query = "SELECT * FROM clien";
                $query_run = mysqli_query($connction, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    ?>





                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>選取</th>
                                <th>序號</th>
                                <th>名字</th>

                                <th>描述</th>
                                <th>頭貼</th>
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
                                        <td><input type="checkbox" onclick="toggleCheckbox(this)" value="<?php echo $row['id']; ?>" <?php echo $row['visible'] == 1 ? "checked" : "" ?>></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>

                                        <td><?php echo $row['descrip']; ?></td>
                                        <td><?php echo '<img src="upload/' . $row['image'] . '" alt="image" width="100px;" height="100px;">' ?></td>
                                        <td>
                                            <form action="clien_edit.php" method="POST">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="edit_data_btn" class="btn btn-success">編輯</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="clien_delete_btn" class="btn btn-danger">刪除</button>
                                            </form>
                                        </td>
                                    </tr>
                        <?php
                                }
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

                <h5 class="modal-title" id="exampleModalLabel">新增會員內容</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" name="clien_name" class="form-control" placeholder="Enter Name" required="required" />
                    </div>
                    <div class="form-group">
                        <label>描述</label>
                        <input type="text" name="clien_description" class="form-control" placeholder="Enter Description" required="required" />
                    </div>
                    <div class="form-group">
                        <label>頭貼</label>
                        <input type="file" name="clien_image" id="clien_image" class="form-control" required="required" />
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save_clien">Save </button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleCheckbox(box) {
        var id = $(box).attr("value");
        if ($(box).prop("checked") == true) {
            var visible = 1;
        } else {
            var visible = 0;
        }

        var data = {
            "search_data": 1,
            "id": id,
            "visible": visible
        };
        $.ajax({
            type: "post",
            url: "code.php",
            data: data,
            success: function(response) {
                alert("Data Cheaked");
            }
        });
    }
</script>


<?php

include('./includes/scripts.php');


?>