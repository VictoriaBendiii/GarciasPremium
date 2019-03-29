<?php

session_start()

?>

<script type="text/javascript">
    function cloneRow()
    {
        var row = document.getElementById("dropdowns");
        var table = document.getElementById("tableDrop");
        var clone = row.cloneNode(true);
        clone.id = "dropdownsclone";
        table.appendChild(clone);
    }

    function RemoveOrder(){
        var td = event.target.parentNode;
        var tr = td.parentNode;
        tr.parentNode.removeChild(tr);
    }
</script>

<!DOCTYPE html>
<html>
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
                <li ><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li ><a href="product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li ><a href="notification.html"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li class="active"><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Admin Deliveries</a></li>
                <li><a href="inventory.html"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li><a href="branch.html"><em class="fa fa-clone">&nbsp;</em> Branch Stock Request </a></li>
                <li><a href="addproduct.html"><em class="fa fa-toggle-off">&nbsp;</em> Add Product</a></li>
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
                    <div style="overflow-x:auto;">
                        <table id="tableDrop">
                            <tr>
                                <th>
                                    <h5>FROM</h5>
                                </th>
                                <th>
                                    <h5>TO</h5>
                                </th>
                                <th>
                                    <h5>COFFEE BEAN</h5>
                                </th>
                                <th>
                                    <h5>QTY(kg)</h5>
                                </th>
                            </tr>

                            <tr id="dropdowns">
                                <th id="from">
                                    <select name="from">
                                        <option value="sablan">Sablan</option>
                                        <option value="atok">Atok</option>
                                    </select>
                                </th>
                                <th id="to">
                                    <select name="to">
                                        <option value="market">Market</option>
                                        <option value="porta">Porta Vaga</option>
                                    </select>
                                </th>
                                <th id="beans">
                                    <select name="beans[]">
                                        <option value="premExcelsa">Premium Barako Excelsa</option>
                                        <option value="arabmed">Arabica Medium Blend</option>
                                        <option value="barako">Barako Blend Coffee</option>
                                        <option value="benguet">Benguet</option>
                                        <option value="barako">Barako</option>
                                        <option value="sagdark">Sagada Dark</option>
                                        <option value="sagmed">Sagada Medium</option>
                                        <option value="housearab">House Blend Arabica</option>
                                        <option value="italesp">Italian Espresso</option>
                                        <option value="kalmed">Kalinga Medium</option>
                                        <option value="kaldark">Kalinga Dark</option>
                                        <option value="hazelnut">Hazelnut</option>
                                        <option value="mocha">Mocha</option>
                                        <option value="hazelvan">Hazelnut-Vanilla</option>
                                        <option value="vanilla">Vanilla</option>
                                        <option value="butterscotch">Butterscotch</option>
                                        <option value="macadamia">Macadamia</option>
                                        <option value="cinnamon">Cinnamon Nut</option>
                                        <option value="irish">Irish Cream</option>
                                        <option value="caramel">Caramel</option>
                                        <option value="cookiescream">Cookies and Cream</option>
                                        <option value="baileys">Bailey''s Irish Cream</option>
                                        <option value="doublechoco">Double Chocolate</option>
                                    </select>
                                </th>
                                <th id="quantity">
                                    <input type="text" name="beans[]" placeholder="Enter Quantity">
                                </th>
                                <th id="remove">
                                    <input type="button" value="&#10006;" onclick="RemoveOrder()">
                                </th>
                            </tr>
                        </table>
                    </div>
                    <table>
                        <br>
                        <tr>
                            <td><input type="button" onclick="cloneRow()" value="Add Order" class="btn btn-secondary"/></td>
                            <td><input type="submit" name="submit" value="Submit	" class="btn btn-primary"/></td>
                        </tr>
                    </table>
                    </form>
            </div>

        </div>
        </div>


    </div><!--/.row-->
</div>	<!--/.main-->


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
</html>
