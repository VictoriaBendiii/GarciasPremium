<?php
    include '../includes/connection.php';
    include '../includes/header.php';
?>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li ><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li ><a href="../notification/notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li class="active"><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Deliveries</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-clone">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-clone">&nbsp;</em> Suppliers </a></li>
                <li><a href="../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Admin Deliveries</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Deliveries</h1>
                </div>

            </div><!--/.row-->

            <!-- FORM CONTAINER -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                        <form id="contact-form" class="form" action="delivery.php" method="POST" role="form">
                            <div class="form-group">
                                <label class="form-label" for="product"> Product </label>
                                <select class="form-control" id="product" name="product">
                                    <option value="Premium Barako Excelsa">Premium Barako Blend</option>
                                    <option value="Arabica Medium Blend"> Arabica Medium Blend   </option>
                                    <option value="Benguet"> Benguet </option>
                                    <option value="Barako"> Barako </option>
                                    <option value="Sagada Dark"> Sagada Dark </option>
                                    <option value="Sagada Medium"> Sagada Medium </option>
                                    <option value="HouseBlendArabica"> House Blend Arabica   </option>
                                    <option value="ItalianEspresso"> Italian Espresso  </option>
                                    <option value="KalingaMedium"> Kalinga Medium </option>
                                    <option value="KalingaDark"> Kalinga Dark </option>
                                    <option value="Hazelnut"> Hazelnut </option>
                                    <option value="Mocha"> Mocha </option>
                                    <option value="HazelnutVanilla"> Hazelnut Vanilla</option>
                                    <option value="Vanilla"> Vanilla </option>
                                    <option value="Butterscotch"> Butterscotch</option>
                                    <option value="Macadamia"> Macadamia</option>
                                    <option value="CinnamonNut"> Cinnamon Nut</option>
                                    <option value="Irish Cream"> Irish Cream</option>
                                    <option value="Caramel"> Caramel</option>
                                    <option value="CookiesAndCream"> Cookies and Cream </option>
                                    <option value="BaileysIrishCream"> Bailey's Irish Cream</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="quantity">Quantity (kg)</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                       placeholder="e.g. 20" min="1" max = "1000" tabindex="1" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="product"> Supplier </label>
                                <select class="form-control" id="product" name="supplier">
                                    <option value="Atok">Atok</option>
                                    <option value="Sablan">Sablan</option>
                                    <option value="Market">Market</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-start-order" name="add_delivery" id="add_delivery"></input>
                            </div>
                        </form>
                </div>


            </div>
        </div>


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
