<?php
    include 'template/dashboardhead.php';
?>

<?php

    $dbhandle = new mysqli('localhost', 'root', '', 'garciaspremiumcoffee');
echo $dbhandle -> connect_error;

$query = "SELECT * FROM products join stock on products.productid = stock.productid WHERE stock.branchid = '1'";
$res = $dbhandle->query($query);
?>



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
            <button style="width:33.3%" class="active"><a href="mainchart.php">Main Branch</a></button>
            <button style="width:33.3%"><a href="subchart.php">Sub Branch</a></button>
           
             </div>


    <div>
        <script type="text/javascript" src="js/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['name', 'quantity'],

                    <?php
                    while($row = $res -> fetch_assoc())
                    {
                        echo "['".$row['name']."',".$row['quantity']."],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Main Branch'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>

        </head>
    <body>
        <div id="piechart" style="width: 600px; height: 500px;"></div>



        </div>

<?php 
    include 'template/footer.php';
?>