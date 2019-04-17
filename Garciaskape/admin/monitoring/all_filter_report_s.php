<?php  
session_start();
include '../includes/connection.php';

$query = "SELECT products.productname as name, branch.branchid, branch.branch_name as bname, supplier.supplier_name as sname, accounts.firstname as fname, stock.quantity as stock, orders.quantity as qty, solditem.quantity as sold, orders.time as t
from ((((((orders left join products on orders.productid = products.productid)
left join branch on orders.branchid = branch.branchid)
left join supplier on orders.supplierid = supplier.supplierid)
left join accounts on orders.accountid = accounts.accountid)
left join stock on orders.stockid = stock.stockid)
left join solditem on orders.solditemid = solditem.solditemid) 
where branch.branchid =2";  
$result = mysqli_query($conn, $query);  
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Garcias Premium Coffee</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/datepicker3.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../css/add.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  


        <!--  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

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
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li class="active"><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Deliveries</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-clone">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/addproduct.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/addsupplier.php"><em class="fa fa-clone">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Product Monitoring</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Monitoring</h1>
                </div>


            </div><!--/.row-->

            <div class="btn-group" style="width:100%">
                <button onclick="location.href='../monitoring/product.php'" style="width:33.3%">Market</button>
                <button class="btn btn-primary active" onclick="location.href='../monitoring/productsub.php'" style="width:33.3%">Porta</button>
                <button class="btn btn-primary active" onclick="location.href='all_filter_report_s.php'" style="width:33.3%">Filter</button>

            </div>
            <br>
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='ordered_filter_report_s.php'" style="width:33.3%">Ordered Report</button>
                <button  onclick="location.href='delivered_filter_report_s.php'" style="width:33.3%">Delivery Report</button>
                <button onclick="location.href='sold_item_filter_report_s.php'" style="width:33.3%">Sold Item Report</button>
            </div>


            <div class="table-responsive">
                <div ng-app="producttable" ng-controller="controller">
                    <br/>
                    <br/>
                    <div class="row" >
                        <div class=".col-xs-4 pull-left" style="margin-left: 1.5%">  
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
                        </div> 
                        <div class=".col-xs-4 pull-left" style="margin-left: 1.5%">  
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
                        </div>
                        <div class=".col-xs-4 pull-left" style="margin-left: 1.5%">  
                            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  
                        </div>

                        <div style="clear:both"></div>  
                    </div>
                    <br>

                    <br/>
                    <div class="row">
                        <div class="col-md-12"  id="order_table"ng-show="filter_data > 0">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th width="10%">Branch</th>  
                                    <th width="20%">Account Name</th>  
                                    <th width="20%">Product Name</th>  
                                    <th width="10%">Supplier</th>  
                                    <th width="10%">Quantity (Stock)</th>
                                    <th width="10%">Quantity (Sold)</th>
                                    <th width="20%">Time Sold</th> 
                                </tr>
                                <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                    <?php  
                                    while($row = mysqli_fetch_array($result)){  
                                    ?>  
                                <tr>  
                                    <td><?php echo $row["bname"]; ?></td>  
                                    <td><?php echo $row["fname"]; ?></td>  
                                    <td><?php echo $row["name"]; ?></td>  
                                    <td><?php echo $row["sname"]; ?></td>  
                                    <td><?php echo $row["stock"]; ?></td> 
                                    <td><?php echo $row["sold"]; ?></td>  
                                    <td><?php echo $row["t"]; ?></td>   
                                </tr>  
                                <?php  
                                    }  
                                ?>  

                            </table>
                        </div>


                    </div>






                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
                <script src="..js/producttable.js"></script>

            </div>










        </div><!--/.row-->

        </div>	<!--/.main-->


    <!--     <script src="js/jquery-1.11.1.min.js"></script> -->
    <!--     <script src="js/bootstrap.min.js"></script> -->
    <script src="../js/chart.min.js"></script>
    <script src="../js/chart-data.js"></script>
    <script src="../js/easypiechart.js"></script>
    <script src="../js/easypiechart-data.js"></script>
    <!--     <script src="js/bootstrap-datepicker.js"></script> -->
    <script src="../js/custom.js"></script>

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
</html>
<script>  
    $(document).ready(function(){  
        $.datepicker.setDefaults({ 
            dateFormat: 'yy-mm-dd 00:00:00'   
        });  
        $(function(){  
            $("#from_date").datepicker();  
            $("#to_date").datepicker();  
        });  
        $('#filter').click(function(){  
            var from_date = $('#from_date').val();  
            var to_date = $('#to_date').val();  
            if(from_date != '' && to_date != '')  
            {  
                $.ajax({  
                    url:"all_filter_report_table_s.php",  
                    method:"POST",  
                    data:{from_date:from_date, to_date:to_date},  
                    success:function(data)  
                    {  
                        $('#order_table').html(data);  
                    }  
                });  
            }  
            else  
            {  
                alert("Please Select Date");  
            }  
        });  
    });  
</script>