<?php
$connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
if (mysqli_connect_errno()) {
    die("資料庫爆掉");
}


$query = "SELECT `browser_name` as browser_name,COUNT(*) as count FROM visitor GROUP BY `browser_name`";
$result = mysqli_query($connection, $query);

$data = array();
foreach ($result as $row){
    $data[] = $row;
    
}
print json_encode($data);
//print_r($data);




?>