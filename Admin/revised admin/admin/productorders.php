<?php
include 'template/productmhead.php';
?>
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
                <button style="width:33.3%"><a href="productorderm.php">Market</a></button>
                <button style="width:33.3%"><a href="productorders.php">Porta</a></button>
            </div>

<div ng-app="producttable2" ng-controller="controller">
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
                    </select>
                </div>
            </div>
            <br/>
               <div class="row">
                <div class="col-md-12" ng-show="filter_data > 0">
                   <label>Sort By</label>
                    <table class="table table-striped table-bordered">
                        <th>Product Name&nbsp; &nbsp;<a ng-click="sort_with('name');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Supplier&nbsp; &nbsp;<a ng-click="sort_with('supplierid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Delivery&nbsp; &nbsp;<a ng-click="sort_with('deliveryid');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Quantity&nbsp; &nbsp;<a ng-click="sort_with('quantity');"><i class="glyphicon glyphicon-sort"></i></a></th>
                        <th>Time&nbsp; &nbsp;<a ng-click="sort_with('time');"><i class="glyphicon glyphicon-sort"></i></a></th>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" ng-show="filter_data > 0">
                    <table class="table table-striped table-bordered">
                        <thead>
                             <th>Product Name&nbsp;</th>
                           <th>Supplier&nbsp;</th>
                            <th>Delivery&nbsp;</th>
                            <th>Quantity&nbsp;</th>
                            <th>Time sold&nbsp;</th>
                        </thead>
                        <tbody>
                            <tr ng-repeat="data in searched = (file | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                 <td>{{data.name}}</td>
                                <td>{{data.supplierid}}</td>
                                <td>{{data.deliveryid}}</td>
                                <td>{{data.quantity}}</td>
                                <td>{{data.time}}</td>
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
    <script src="js/producttable2.js"></script>
    
</div><!--/.row-->
</div>	<!--/.main-->









<?php
include 'template/footer.php';
?>