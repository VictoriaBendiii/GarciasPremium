<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../../index.php?session_expired=1");
}

include '../includes/connection.php';
include '../includes/header.php';
include '../includes/sidebar.php';
include '../inventory/query.php';

?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                 <ol class="breadcrumb">
                    <li><a href="product.php">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li><a href="product.php">Product Monitoring</a></li>
                    <li class="active">Market</li>
                </ol>

            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Monitoring <?php echo $row['branch_name']; ?> </h1>
                </div>
            </div><!--/.row-->

            <div class="btn-group" style="width:100%">
                <button class="btn btn-primary active" onclick="location.href='market.php'" style="width:50%; border-radius: 30px;">Market</button>
                <button onclick="location.href='porta.php'" style="width:50%;  border-radius: 30px;">Porta</button>
            </div>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-12 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                	 <br> <br>
                    <form action="market.php" method="POST">
                        <div class="btn-change btn-group-justified" role="group" aria-label="...">

                            <div class="btn-group" role="group">
                                <button style="border-radius: 30px;" type="submit" class="btn btn-default" name="req_rep" id="req_rep">Order Request Reports</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button style="border-radius: 30px;" type="submit" class="btn btn-default" name="del_rep" id="del_rep">Delivery Reports</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button style="border-radius: 30px;" type="submit" class="btn btn-default" name="ord_rep" id="ord_rep">Order Reports</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button style="border-radius: 30px;" type="submit" class="btn btn-default" name="sold_rep" id="sold_rep">Sold Reports</button>
                            </div>
                        </div>
                    </form>
                </div>




<?php
        if (isset($_POST['req_rep'])) {
        ?>

        <div ng-app="requesttable" ng-controller="controller">
            <br/>
            <br/>
            <div class="row">
                <div class="col-sm-2 pull-left">
                    <label>Display Rows:</label>
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

            </div>
            <br/>
            <div class="row">
                <div class="col-md-14" ng-show="filter_data > 0">
                    <table id ="tableExport" class="table table-striped table-bordered">
                        <thead>
                            <!-- <th>Branch&nbsp;</th> -->
                            <th>Branch&nbsp; &nbsp;<a ng-click="sort_with('branch_name');"></a></th>
                            <th>Account Name&nbsp; &nbsp;<a ng-click="sort_with('firstname');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('productname');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Supplier&nbsp; &nbsp;<a ng-click="sort_with('supplier_name');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Quantity (in kg)&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Time Ordered&nbsp; &nbsp;<a ng-click="sort_with('time');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Status&nbsp; &nbsp;<a ng-click="sort_with('status');"><i class="glyphicon fa fa-sort"></i></a></th>
                        </thead>
                        <tbody>
                            <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                <!-- <td>{{data.branch_name}}</td> -->
                                <td>{{data.branch_name}}</td>
                                <td>{{data.firstname}}</td>
                                <td>{{data.productname}}</td>
                                <td>{{data.supplier_name}}</td>
                                <td>{{data.quantity}}</td>
                                <td>{{data.time}}</td>
                                <td>{{data.status}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12" ng-show="filter_data == 0">
                    <div class="col-md-12">
                        <h4>No records found</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-left">
                        <h6>Showing {{searched.length}} of {{entire_user}} entries.</h6>
                    </div>
                    <div class="col-md-6" ng-show="filter_data > 0">
                        <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                    </div>
                </div>
            </div>
        </div>



        <script src="../js/requesttable.js"></script>
        <script src="../js/export.js""></script>
        <script>
          function check(data){
            if(confirm("Are you sure? ")){
                exportToExcelRequest(data);

            }
          }
        </script>

        <button onclick="check('tableExport')" class="btn btn-primary">Export Data To Excel File</button>
        <br><br>





        </div><!--/.row-->

    </div>  <!--/.main-->
<?php
        }
?>
















        <?php
        if (isset($_POST['ord_rep'])) {
        ?>

        <div ng-app="ordered_m" ng-controller="controller">
            <br/>
            <br/>
            <div class="row">
                <div class="col-sm-2 pull-left">
                    <label>Display Rows:</label>
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

            </div>
            <br/>
            <div class="row">
                <div class="col-md-14" ng-show="filter_data > 0">
                    <table id ="tableExport" class="table table-striped table-bordered">
                        <thead>
                            <!-- <th>Branch&nbsp;</th> -->
                            <th>Branch&nbsp; &nbsp;<a ng-click="sort_with('branch_name');"></a></th>
                            <th>Account Name&nbsp; &nbsp;<a ng-click="sort_with('firstname');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('productname');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Quantity (in kg)&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon fa fa-sort"></i></a></th>
                            <th>Time Ordered&nbsp; &nbsp;<a ng-click="sort_with('time');"><i class="glyphicon fa fa-sort"></i></a></th>

                        </thead>
                        <tbody>
                            <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                <!-- <td>{{data.branch_name}}</td> -->
                                <td>{{data.branch_name}}</td>
                                <td>{{data.firstname}}</td>
                                <td>{{data.productname}}</td>
                                <td>{{data.quantity}}</td>
                                <td>{{data.time}}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12" ng-show="filter_data == 0">
                    <div class="col-md-12">
                        <h4>No records found</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 pull-left">
                        <h6>Showing {{searched.length}} of {{entire_user}} entries.</h6>
                    </div>
                    <div class="col-md-6" ng-show="filter_data > 0">
                        <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                    </div>
                </div>
            </div>
        </div>



        <script src="../js/ordered_m.js"></script>
        <script src="../js/export.js""></script>
         <script>
          function check(data){
            if(confirm("Are you sure? ")){
                exportToExcelOrder(data);

            }
          }
        </script>

        <button onclick="check('tableExport')" class="btn btn-primary">Export Data To Excel File</button>
        <br><br>





        </div><!--/.row-->

    </div>  <!--/.main-->
<?php
        }
?>




<?php
if (isset($_POST['del_rep'])) {
    ?>

<div ng-app="deliveredtablem" ng-controller="controller">
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-2 pull-left">
            <label>Display Rows:</label>
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

    </div>
    <br/>
    <div class="row">
        <div class="col-md-14" ng-show="filter_data > 0">
            <table id ="tableExport" class="table table-striped table-bordered">
                <thead>
                    <!-- <th>Branch&nbsp;</th> -->
                    <th>Branch&nbsp; &nbsp;<a ng-click="sort_with('branch_name');"></a></th>
                    <th>Account Name&nbsp; &nbsp;<a ng-click="sort_with('firstname');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('productname');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Supplier&nbsp; &nbsp;<a ng-click="sort_with('supplier_name');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Quantity (in kg)&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Time Ordered&nbsp; &nbsp;<a ng-click="sort_with('time');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Time Delivered&nbsp; &nbsp;<a ng-click="sort_with('dtime');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Status&nbsp; &nbsp;<a ng-click="sort_with('status');"><i class="glyphicon fa fa-sort"></i></a></th>
                </thead>
                <tbody>
                    <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                        <!-- <td>{{data.branch_name}}</td> -->
                        <td>{{data.branch_name}}</td>
                        <td>{{data.firstname}}</td>
                        <td>{{data.productname}}</td>
                        <td>{{data.supplier_name}}</td>
                        <td>{{data.quantity}}</td>
                        <td>{{data.time}}</td>
                        <td>{{data.dtime}}</td>
                        <td>{{data.status}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12" ng-show="filter_data == 0">
            <div class="col-md-12">
                <h4>No records found</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 pull-left">
                <h6>Showing {{searched.length}} of {{entire_user}} entries.</h6>
            </div>
            <div class="col-md-6" ng-show="filter_data > 0">
                <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
        </div>
    </div>
</div>



<script src="../js/deliveredtablem.js"></script>
<script src="../js/export.js""></script>
<script>
          function check(data){
            if(confirm("Are you sure? ")){
                exportToExcelDelivery(data);

            }
          }
        </script>

        <button onclick="check('tableExport')" class="btn btn-primary">Export Data To Excel File</button>


<br><br>





</div><!--/.row-->

</div>  <!--/.main-->
<?php
}
?>

<?php
if (isset($_POST['sold_rep'])) {

?>

<div ng-app="solditemtablem" ng-controller="controller">
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-2 pull-left">
            <label>Display Rows:</label>
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

    </div>
    <br/>
    <div class="row">
        <div class="col-md-14" ng-show="filter_data > 0">
            <table id ="tableExport" class="table table-striped table-bordered">
                <thead>
                    <!-- <th>Branch&nbsp;</th> -->
                    <th>Branch&nbsp; &nbsp;<a ng-click="sort_with('branch_name');"></a></th>
                    <th>Account Name&nbsp; &nbsp;<a ng-click="sort_with('firstname');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('productname');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Quantity (in kg)&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Time Ordered&nbsp; &nbsp;<a ng-click="sort_with('ordertime);"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Time Sold&nbsp; &nbsp;<a ng-click="sort_with('time');"><i class="glyphicon fa fa-sort"></i></a></th>
                    <th>Status&nbsp; &nbsp;<a ng-click="sort_with('status');"><i class="glyphicon fa fa-sort"></i></a></th>
                </thead>
                <tbody>
                    <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                        <!-- <td>{{data.branch_name}}</td> -->
                        <td>{{data.branch_name}}</td>
                        <td>{{data.firstname}}</td>
                        <td>{{data.productname}}</td>
                        <td>{{data.quantity}}</td>
			    <td>{{data.ordertime}}</td>
                        <td>{{data.time}}</td>
                        <td>{{data.status}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12" ng-show="filter_data == 0">
            <div class="col-md-12">
                <h4>No records found</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 pull-left">
                <h6>Showing {{searched.length}} of {{entire_user}} entries.</h6>
            </div>
            <div class="col-md-6" ng-show="filter_data > 0">
                <div pagination="" page="current_grid" on-select-page="page_position(page)" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
            </div>
        </div>
    </div>
</div>

<script src="../js/solditemtablem.js"></script>
<script src="../js/export.js""></script>
<script>
          function check(data){
            if(confirm("Are you sure? ")){
                exportToExcelSoldItem(data);

            }
          }
        </script>

        <button onclick="check('tableExport')" class="btn btn-primary">Export Data To Excel File</button>

<br><br>


</div><!--/.row-->
</div>  <!--/.main-->
<?php
}
?>

</main>




</body>
</html>
