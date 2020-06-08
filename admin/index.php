<?php
include('security.php');
include('./includes/header.php');
include('./includes/navbar.php');

?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('./includes/Topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">會員數量</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        require('./database/dbconfig.php');
                                        $query = "SELECT id FROM register ORDER BY id";

                                        $query_run = mysqli_query($connction, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo $row . "位會員";
                                        ?>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">貼文數量</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        require('./database/dbconfig.php');
                                        $query = "SELECT id FROM abouts ORDER BY id";

                                        $query_run = mysqli_query($connction, $query);
                                        $row = mysqli_num_rows($query_run);
                                        echo $row . "則貼文";
                                        ?>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fas fa-blog fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">網站總瀏覽量</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                                <?php

                                                $connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
                                                if (mysqli_connect_errno()) {
                                                    die("資料庫爆掉");
                                                }

                                                $query = "SELECT * FROM visitor_counter";
                                                $result = mysqli_query($connection, $query);

                                                $total_visitors = mysqli_num_rows($result);

                                                echo $total_visitors . "位";


                                                ?>

                                            </div>

                                        </div>
                                        <div class="col">
                                            <!-- <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">留言最活躍會員</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                        <?php

                                        $connection = mysqli_connect('localhost', 'root', '', 'wait');
                                        if (mysqli_connect_errno()) {
                                            die("資料庫爆掉");
                                        }

                                        $query = "SELECT `userID` as userID,users.name,COUNT(*) AS user_count FROM users INNER JOIN comments ON users.id=comments.userID GROUP BY `userID` ORDER BY user_count DESC LIMIT 1";
                                        $result = mysqli_query($connection, $query);
                                        while ($row = mysqli_fetch_assoc($result))
                                        echo $row['name'];


                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">客戶造訪折線圖（動態）</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">用戶使用瀏覽器類型圓餅圖（動態）</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-broadcast-tower"></i> 用戶流量來源瀏覽器類型
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>
</div>







</div>
<!-- End of Page Wrapper -->


<?php


include('./includes/scripts.php');

$dbhost = 'localhost';
$dbname = 'adminpanel';
$dbuser = 'root';
$dbpass = '';

try {
    $dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die($ex->getMessage());
}
$stmt = $dbcon->prepare("SELECT `browser_name` as browser_name,COUNT(*) as count_name FROM visitor GROUP BY `browser_name`");
$stmt->execute();
$json = [];
$json1 = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $json[] = $browser_name;
    $json1[] = (int) $count_name;
}



$stmt = $dbcon->prepare("SELECT `visit_date` as visi_date,COUNT(*) as people_count FROM visitor_counter GROUP BY `visit_date`");
$stmt->execute();
$json3 = [];
$json4 = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $json3[] = $visi_date;
    $json4[] = (int) $people_count;
}


?>

<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($json)  ?>,
            datasets: [{
                data: <?php echo json_encode($json1)  ?>,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,

            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20,

                }
            },
            cutoutPercentage: 50,

        },
    });

    <?php



    ?>


    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    var ctx = document.getElementById('myAreaChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($json3)  ?>,
            datasets: [{
                label: "拜訪流量",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,

                data: <?php echo json_encode($json4)  ?>,
            }],
        },
        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20,

                }
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>