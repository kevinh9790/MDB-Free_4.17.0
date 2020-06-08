<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php
$server_name = "localhost";
$db_username = "root";
$db_password="";
$db_name = "adminpanel";


$connction = mysqli_connect($server_name, $db_username,$db_password);

$dbconfig =mysqli_select_db($connction,$db_name);

if($dbconfig){
    //echo "資料庫連結";
}else{
   echo'                <div class="container-fluid">

   <!-- 404 Error Text -->
   <div class="text-center">
   <div class="error mx-auto" data-text="BOOM">BOOM</div>
       <p class="lead text-gray-800 mb-5">Database is not connect</p>
       <p class="text-gray-500 mb-0">沒有資料庫你啥也幹不了:(...</p>
       <a href="#">甲賽吧</a>
   </div>

</div>';
}

?>