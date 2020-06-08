<?php
include('./includes/header.php');
include('./includes/navbar.php');

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "adminpanel";


$connction = mysqli_connect($server_name, $db_username, $db_password);

$dbconfig = mysqli_select_db($connction, $db_name);


if (isset($_POST['react'])) {
    $commentID = $connction->real_escape_string($_POST['commentID']);
    $type = $connction->real_escape_string($_POST['type']);

    $sql = $connction->query("SELECT id FROM reactions WHERE commentID='$commentID'");

    if ($sql->num_rows > 0) {
        $status = "updated";
        $connction->query("UPDATE reactions SET type='$type' WHERE commentID='$commentID'");
    } else {
        $status = "inserted";
        $connction->query("INSERT INTO reactions(type,commentID) VALUE ('$type','$commentID')");
    }

    exit(json_encode(array('status' => $status)));
}





?>
這是介紹網頁
<div class="container py-5">
    <div class="row py-3">
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <img src="./img/blog.jpg" class="card-img-top" alt="blog title image">
                </div>
            </div>
            <br>

            <?php
            require('./admin/database/dbconfig.php');

            $query = "SELECT * FROM abouts ";
            $query_run = mysqli_query($connction, $query);

            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    ?>



                    <div class="card">
                        <div class="card-body">

                            <?php echo '<img src="admin/upload/blog/' . $row['image'] . '" alt="image" width="100%;" height="auto; >' ?>

                            <h1 class="card-title"><?php echo $row['title']; ?></h1> <span class="time timeago" data-date="<?php echo $row['creat_data'] ?>" style="color: gray;"></span>
                            <h6><?php echo $row['subtitle']; ?></h6>

                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <div class="text-center">
                                <form action="../Like & Dislike & Time Ago 2/index.php" method="POST">
                                    <input type="hidden" name="select_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="select_btn" class="btn btn-primary">我要留言</button>

                                </form>
                            </div>

                        </div>
                    </div>
                    <br>
            <?php
                }
            } else {
                echo "沒有資料";
            }

            ?>



        </div>
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">最新內容</h5>
                    <p class="card-text"> 所有新的消息都在這裡</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>

            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">最新內容</h5>
                    <p class="card-text"> 所有新的消息都在這裡</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>

            </div>


        </div>


    </div>
</div>


<?php include('./includes/footer.php') ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('.timeago').each(function() {
            var timeAgo = $.timeago($(this).attr('data-date'));
            $(this).text(timeAgo);
            $(this).removeClass('timeago');
        });

    });

    function react(caller, commentID, type) {

        $.ajax({
            url: 'abouts.php',
            method: 'POST',
            dataType: 'json',
            data: {
                react: 1,
                commentID: commentID,
                type: type
            },
            success: function(response) {
                if (response.status === 'updated') {

                    if (type === 'up')
                        $(caller).next().css('color', '');
                    else
                        $(caller).prev().css('color', '');
                }
                $(caller).css('color', 'blue');
            }
        });
    }
</script>