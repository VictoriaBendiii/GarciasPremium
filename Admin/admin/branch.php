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
                <li ><a href="index..php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li ><a href="product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li ><a href="notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li ><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Admin Deliveries</a></li>
                <li ><a href="inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li class="active"><a href="branch.php"><em class="fa fa-clone">&nbsp;</em> Branch Stock Request </a></li>
                <li><a href="addproduct.php"><em class="fa fa-toggle-off">&nbsp;</em> Add Product</a></li>
                <li><a href="addaccount.php"><em class="fa fa-clone">&nbsp;</em> Add Account </a></li>
                <li><a href="login.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Branch Stock Request</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Branch Stock Request</h1>
                </div>
            </div><!--/.row-->

        </div><!--/.row-->
        </div>	<!--/.main-->

    <main role="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                ADD DELIVERY TO MARKET
            </button>
            </br> 
        </br>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Deliveries</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="apismsphp">
            <table align="center">
                <tr>
                    <td>sender:</td>
                    <td><input type="text" name="sender" placeholder="enter your name"></td>
                </tr>
                <tr>
                    <td>number:</td>
                    <td><input type="text" name="num" placeholder="enter your number"></td>
                </tr>
            </table>
            <table style="width: 50%" id="table">
                <tr>
                    <th>
                        <h3>FROM</h3>
                    </th>
                    <th>
                        <h3>TO</h3>
                    </th>
                    <th>
                        <h3>COFFEE BEAN</h3>
                    </th>
                    <th>
                        <h3>QTY(kg)</h3>
                    </th>
                </tr>

                <tr id="dropdowns">
                    <th id="from">
                        <select>
                            <option value="sablan">Sablan</option>
                            <option value="atok">Atok</option>
                        </select>
                    </th>
                    <th id="to">
                        <select>
                            <option value="market">Market</option>
                            <option value="porta">Porta Vaga</option>
                        </select>
                    </th>
                    <th id="beans">
                        <select name="bean[]">
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
                        <input type="text" name="bean[]" placeholder="enter quantity">
                    </th>
                </tr>
            </table>
        </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

</br>
</main>

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
</php>