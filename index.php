<?php

include('./includes/caraousel.php');
include('./includes/navbar.php');
include('./includes/header.php');

include('Mobile_Detect.php');
include('BrowserDetection.php');

$connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
if (mysqli_connect_errno()) {
    die("資料庫爆掉");
}

$visitor_ip = $_SERVER['REMOTE_ADDR'];
//$visitor_ip = '140.8.45.10';
//test


$query = "SELECT * FROM visitor_counter WHERE ip_address = '$visitor_ip'";
$result = mysqli_query($connection, $query);

$total_visitors = mysqli_num_rows($result);



if ($total_visitors < 1) {
    $query = "INSERT INTO visitor_counter(ip_address,visit_date) VALUES('$visitor_ip',NOW())";
    $result = mysqli_query($connection, $query);
}
//判斷顧客來源PHP
$browser = new Wolfcast\BrowserDetection;

$browser_name = $browser->getName();
$browser_version = $browser->getVersion();

$detect = new Mobile_Detect();

if ($detect->isMobile()) {
    $type = 'Mobile';
} elseif ($detect->isTablet()) {
    $type = 'Tablet';
} else {
    $type = 'PC';
}

if ($detect->isiOS()) {
    $os = 'IOS';
} elseif ($detect->isAndroidOS()) {
    $os = 'Android';
} else {
    $os = 'Window/MAC';
}

$url = (isset($_SERVER['HTTPS'])) ? "https" : "http";
$url .= "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ref = '';
if (isset($_SERVER['HTTP_REFERER'])) {
    $ref = $_SERVER['HTTP_REFERER'];
}

if ($total_visitors < 1) {
$sql = "insert into visitor(browser_name,browser_version,type,os,url,ref) values('$browser_name','$browser_version','$type','$os','$url','$ref')";
mysqli_query($connection, $sql);
}



?>


<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>張貼樂譜</h3>
                    <p>貢獻您手中的樂譜豐富整個平台</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>協同補充</h3>
                    <p>貢獻您的寶貴知識充實整個平台</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>錯誤更正</h3>
                    <p>貢獻您的所學讓平台更臻至完美
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2>梁在平古曲解析</h2>
                    <hr>
                    <p>解析梁在平古曲『憶故人』中的作曲手法...</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2>最新內容</h2>
                    <hr>
                    <p>所有新的消息都在這裡</p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('./includes/footer.php') ?>