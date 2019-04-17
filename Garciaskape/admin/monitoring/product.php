<?php
session_start();
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
                <button class="btn btn-primary active" onclick="location.href='product.php'"; style="width:33.3%">Market</button>
                <button onclick="location.href='productsub.php'" style="width:33.3%">Porta</button>
                <button onclick="location.href='all_filter_report_m'"; style="width:33.3%">Filter</button>
            </div>
            <br>
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='ordered_report_m.php'" style="width:33.3%">Ordered Report</button>
                <button onclick="location.href='delivered_report_m.php'" style="width:33.3%">Delivered Report</button>
                <button onclick="location.href='sold_item_report_m.php'" style="width:33.3%">Sold Item Report</button>

            </div>



            <div ng-app="producttable" ng-controller="controller">
                <br/>
                <br/>
                <div class="row">
                    <div class="col-sm-2 pull-left">
                        <label>PageSize:</label>
                        <select ng-model="data_limit" class="form-control">
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                            <option>500</option>
                        </select>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <input type="text" class="form-control input-lg" ng-model="search" ng-change="filter()" placeholder="Search" >
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-12" ng-show="filter_data > 0">
                        <label>Sort By</label>
                        <table class="table table-striped table-bordered">
                            <!-- <th>Branch&nbsp; &nbsp;<a ng-click="sort_with('branch_name');"></a></th> -->
                            <th>Account Name&nbsp; &nbsp;<a ng-click="sort_with('firstname');"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a></th>
                            <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('productname');"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a></th>
                            <th>Stock&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon glyphicon-sort-by-alphabet"></i></a></th>
                            <th>Stock In&nbsp; &nbsp;<a ng-click="sort_with('stockin');"><i class="glyphicon glyphicon-sort-by-order"></i></a></th>
                            <th>Date In&nbsp; &nbsp;<a ng-click="sort_with('date_in');"><i class="glyphicon glyphicon-sort-by-order"></i></a></th>
                            <th>Stock Out&nbsp; &nbsp;<a ng-click="sort_with('stockout');"><i class="glyphicon glyphicon-sort-by-order"></i></a></th>
                            <th>Date Out&nbsp; &nbsp;<a ng-click="sort_with('date_out');"><i class="glyphicon glyphicon-sort-by-order"></i></a></th>
                        </table>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12" ng-show="filter_data > 0">
                        <table id ="tableExport" class="table table-striped table-bordered">
                            <thead>
                                <!-- <th>Branch&nbsp;</th> -->
                                <th>Account Name&nbsp;</th>
                                <th>Product Name&nbsp;</th>
                                <th>Stock (in kg)&nbsp;</th>
                                <th>Stock In(in kg)&nbsp;</th>
                                <th>Date In&nbsp;</th>
                                <th>Stock Out(in kg)&nbsp;</th>
                                <th>Date Out&nbsp;</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                    <!-- <td>{{data.branch_name}}</td> -->
                                    <td>{{data.firstname}}</td>
                                    <td>{{data.productname}}</td>
                                    <td>{{data.quantity}}</td>
                                    <td>{{data.stockin}}</td>
                                    <td>{{data.date_in}}</td>
                                    <td>{{data.stockout}}</td>
                                    <td>{{data.date_out}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12" ng-show="filter_data == 0">
                        <div class="col-md-12">
                            <h4>No records found..</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6 pull-left">
                            <h5>Showing {{ searched.length }} of {{ entire_user}} entries</h5>
                        </div>
                        <div class="col-md-6" ng-show="filter_data > 0">
                            <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
            <script src="../js/producttable.js"></script>
            <script type="text/javascript">
                function exportToExcel(tableID, filename = ''){
                    var downloadurl;
                    var dataFileType = 'application/vnd.ms-excel';
                    var tableSelect = document.getElementById(tableID);
                    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');

                    filename = filename?filename+'.xls':'MarketAllReport.xls';

                    downloadurl = document.createElement("a");

                    document.body.appendChild(downloadurl);

                    if(navigator.msSaveOrOpenBlob){
                        var blob = new Blob(['\ufeff', tableHTMLData], {
                            type: dataFileType
                        });
                        navigator.msSaveOrOpenBlob( blob, filename);
                    }else{

                        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                        downloadurl.download = filename;
                        downloadurl.click();
                    }
                }

            </script>

            <button onclick="exportToExcel('tableExport')" class="btn btn-primary">Export Data To Excel File</button>
            <br><br>





        </div><!--/.row-->

        </div>	<!--/.main-->


    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/chart.min.js"></script>
    <script src="../js/chart-data.js"></script>
    <script src="../js/easypiechart.js"></script>
    <script src="../js/easypiechart-data.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
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