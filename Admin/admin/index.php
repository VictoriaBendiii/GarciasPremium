
<?php
session_start();
$dbhandle = new mysqli('localhost', 'root', '', 'garciaspremiumcoffee');
echo $dbhandle -> connect_error;
$query = "SELECT products.productname, branch.branchid, stock.quantity, stock.stockin, stock.stockout, date
from ((stock inner join products on stock.productid = products.productid) inner join branch on stock.branchid = branch.branchid) where branch.branchid=1";
$res = $dbhandle->query($query);
?>


<!DOCTYPE php>
<php>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Garcias Premium Coffee</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/add.css" rel="stylesheet">

        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="#"><span></span>Admin</a>
                    <br>
                    <p> Eddie Garcia </p>


                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Admin Deliveries</a></li>
                <li><a href="inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li><a href="branch.php"><em class="fa fa-clone">&nbsp;</em> Branch Stock Request </a></li>
                <li><a href="addproduct.php"><em class="fa fa-toggle-off">&nbsp;</em> Add Product</a></li>
                <li><a href="addaccount.php"><em class="fa fa-clone">&nbsp;</em> Add Account </a></li>
                <li><a href="../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Total Stocks Remaining</h1>
                </div>
            </div><!--/.row-->
            <div class="btn-group" style="width:100%">
                <button style="width:33.3%" class="active"><a href="index.php">Main Branch</a></button>
                <button style="width:33.3%"><a href="subchart.php">Sub Branch</a></button>

            </div>
        </div><!--/.row-->

        </div>	<!--/.main-->
	<div style="padding-left: 300px; padding-top: 200px">
    <script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['productname', 'quantity'],

                <?php
                while($row = $res -> fetch_assoc())
                {
                    echo "['".$row['productname']."',".$row['quantity']."],";
                }
                ?>
            ]);

            var options = {
                title: 'Product'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <div id="piechart" style="width: 500px; height: 400px;"></div>
	</div>



    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script>
        window.onload = function () {
            var chart1 = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true,
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc"
            });
        };
    </script>

    </body>
</php>