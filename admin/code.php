<?php

include('./security.php');


if (isset($_POST['cheak_submit_btn'])) {
    $email = $_POST['email_id'];
    $email_query = "SELECT * FROM register WHERE email='$email'";
    $email_query_run = mysqli_query($connction, $email_query);
    if (mysqli_num_rows($email_query_run) > 0) {
        //echo "Email被註冊過，再想個新的吧";
    } else {
        //echo "Email可用";
    }
}

if (isset($_POST['registerbtn'])) {

    $username = $_POST['username'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email='$email'";
    $email_query_run = mysqli_query($connction, $email_query);
    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "email重複註冊";
        header('Location:register.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO register (username,Email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connction, $query);

            if ($query_run) {
                $_SESSION['success'] = "管理員已加入";
                header('Location:register.php');
            } else {
                $_SESSION['status'] = "未能加入管理員";
                header('Location:register.php');
            }
        } else {
            $_SESSION['status'] = "密碼確認驗證不一";
            header('Location:register.php');
        }
    }
}



if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_Email'];
    $password = $_POST['edit_password'];
    $usertypeupdate = $_POST['update_usertype'];

    $query = "UPDATE register SET username='$username',email='$email',password='$password',usertype='$usertypeupdate' WHERE id='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "您的資料已更新";
        header('Location:register.php');
    } else {
        $_SESSION['status'] = "您的資料未更新";
        header('Location:register.php');
    }
}


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM register WHERE id ='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "你的資料已刪除";
        header('Location:register.php');
    } else {
        $_SESSION['status'] = "您的資料未刪除";
        header('Location:register.php');
    }
}

if (isset($_POST['login_btn'])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' ";

    $query_run = mysqli_query($connction, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if ($usertypes['usertype'] == "admin") {
        $_SESSION['username'] = $email_login;
        header('Location:index.php');
    } else if ($usertypes['usertype'] == "user") {
        $_SESSION['username'] = $email_login;
        header('Location:../index.php');
    } else {
        $_SESSION['status'] = "帳號或密碼輸入錯誤";
        header('Location:login.php');
    }
}


if (isset($_POST['about_save'])) {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $image = $_FILES["blog_image"]['name'];

    if (file_exists("upload/blog/" . $_FILES["blog_image"]['name'])) {
        $store = $_FILES["blog_image"]['name'];
        $_SESSION['status'] = "圖檔已經存在'.$store'";
        header('Location:abouts.php');
    } else {
        $query = "INSERT INTO abouts (title,subtitle,description,image) VALUE ('$title','$subtitle','$description','$image')";
        $query_run = mysqli_query($connction, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["blog_image"]["tmp_name"], 'upload/blog/' . $_FILES["blog_image"]['name']); //新增圖片
            $_SESSION['success'] = "會員資料已新增";
            header('Location:abouts.php');
        } else {
            $_SESSION['status'] = "會員資料未新增";
            header('Location:abouts.php');
        }
    }
}


if (isset($_POST['about_update'])) {
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $subtitle = $_POST['edit_subtitle'];
    $description = $_POST['edit_description'];
    $links = $_POST['edit_image'];

    $query = "UPDATE abouts SET title='$title',subtitle='$subtitle',description='$description',image='$links' WHERE id='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "您的資料已更新";
        header('Location:abouts.php');
    } else {
        $_SESSION['status'] = "您的資料未更新";
        header('Location:abouts.php');
    }
}

if (isset($_POST['about_delete_btn'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM abouts WHERE id ='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "你的資料已刪除";
        header('Location:abouts.php');
    } else {
        $_SESSION['status'] = "您的資料未刪除";
        header('Location:abouts.php');
    }
}



if (isset($_POST['save_clien'])) {
    $name = $_POST['clien_name'];
    $description = $_POST['clien_description'];
    $image = $_FILES["clien_image"]['name'];

    if (file_exists("upload/" . $_FILES["clien_image"]["name"])) {
        $store = $_FILES["clien_image"]["name"];
        $_SESSION['status'] = "圖檔已經存在'.$store'";
        header('Location:clien.php');
    } else {
        $query = "INSERT INTO clien (name,descrip,image,visible) VALUE ('$name','$description','$image','0')";
        $query_run = mysqli_query($connction, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["clien_image"]["tmp_name"], 'upload/' . $_FILES["clien_image"]['name']); //新增圖片
            $_SESSION['success'] = "會員資料已新增";
            header('Location:clien.php');
        } else {
            $_SESSION['status'] = "會員資料未新增";
            header('Location:clien.php');
        }
    }
}


if (isset($_POST['clien_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_description = $_POST['edit_description'];
    $edit_image = $_FILES["clien_image"]['name'];

    $query = "UPDATE clien SET name='$edit_name',descrip='$edit_description',image='$edit_image' WHERE id='$edit_id' ";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["clien_image"]["tmp_name"], 'upload/' . $_FILES["clien_image"]['name']); //新增圖片
        $_SESSION['success'] = "會員資料已更改";
        header('Location:clien.php');
    } else {
        $_SESSION['status'] = "會員資料未更改";
        header('Location:clien.php');
    }
}

if (isset($_POST['clien_delete_btn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM clien WHERE id='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "會員資料已刪除";
        header('Location:clien.php');
    } else {
        $_SESSION['status'] = "會員資料未刪除";
        header('Location:clien.php');
    }
}

if (isset($_POST['search_data'])) {
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE clien SET visible ='$visible' WHERE id='$id' ";
    $query_run = mysqli_query($connction, $query);
}

if (isset($_POST['delete_muliple_data'])) {
    $id = "1";

    $query = "DELETE FROM clien WHERE visible='$id'";
    $query_run = mysqli_query($connction, $query);

    if ($query_run) {
        $_SESSION['success'] = "會員資料已刪除";
        header('Location:clien.php');
    } else {
        $_SESSION['status'] = "會員資料未刪除";
        header('Location:clien.php');
    }
}
