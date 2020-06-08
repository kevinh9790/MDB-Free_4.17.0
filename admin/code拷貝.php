<?php

session_start();

$connction = mysqli_connect('localhost', 'root', '', 'adminpanel');

if (isset($_POST['registerbtn'])) {

    $username = $_POST['username'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];


    if ($password === $cpassword) {
        $query = "INSERT INTO register (username,Email,password) VALUES ('$username','$email','$password')";
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


if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_Email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username',email='$email',password='$password' WHERE id='$id'";
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
