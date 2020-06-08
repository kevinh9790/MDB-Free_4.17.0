<?php

session_start();

include('./database/dbconfig.php');

if($dbconfig){
    //echo "資料庫連結";
}else{
    header("Location:database/dbconfig.php");
}

if(!$_SESSION['username']){
    header('Location:login.php');
}


?>