<?php
if(isset($_POST['abc'])){
// Authorisation details.
$username = "aaronferrerquitoriano@gmail.com";
$hash = "4a95acef14a537bb3d32bc6aad8cb80baa9d18f9ac06b3158f50784e6735c4c6";

// Config variables. Consult http://api.txtlocal.com/docs for more info.
$test = "0";

// Data for text message. This is the text message data.
$sender = $_POST['sender']; // This is who the message appears to be from.
$numbers = $_POST['num']; // A single number or a comma-seperated list of numbers
$messageArray = $_POST['beans'];
$message = implode(" ", $messageArray);
// 612 chars or less
// A single number or a comma-seperated list of numbers
$message = urlencode($message);
$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
$ch = curl_init('http://api.txtlocal.com/send/?');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch); // This is the result from the API
curl_close($ch);
}
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

        <script type="text/javascript">

            function cloneRow(){
                var row = document.getElementById("dropdowns");
                var table = document.getElementById("tableDrop");
                var clone = row.cloneNode(true);
                clone.id = "dropdownsclone";
                table.appendChild(clone);
            }

            function RemoveOrder(){
                var rowCount = document.getElementById('tableDrop').rows.length;
                var td = event.target.parentNode;
                var tr = td.parentNode;
                if (rowCount > 2) {
                    tr.parentNode.removeChild(tr);
                } else {
                    alert("Should have atleast one order!");
                }
            }
        </script>

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
                <li ><a href="notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li class="active"><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Admin Deliveries</a></li>
                <li ><a href="inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li ><a href="branch.php"><em class="fa fa-clone">&nbsp;</em> Branch Stock Request </a></li>
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

    <main role="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="addbtn black circular" data-toggle="modal" data-target="#exampleModalCenter">
                ADD DELIVERY TO MARKET
            </button>
            <br> 
            <br>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Deliveries</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="pushnotif.php">
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
                                            <h5>QUANTITY(kg)</h5>
                                        </th>
                                        <th>
                                            <h5>REMOVE ORDER</h5>
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
                                                <option value="Premium Barako Excelsa-">Premium Barako Excelsa</option>
                                                <option value="Arabica Medium Blend-">Arabica Medium Blend</option>
                                                <option value="Barako Blend Coffee-">Barako Blend Coffee</option>
                                                <option value="Benguet-">Benguet</option>
                                                <option value="Barako-">Barako</option>
                                                <option value="Sagada Dark-">Sagada Dark</option>
                                                <option value="Sagada Medium-">Sagada Medium</option>
                                                <option value="House Blend Arabica-">House Blend Arabica</option>
                                                <option value="Italian Espresso-">Italian Espresso</option>
                                                <option value="Kalinga Medium-">Kalinga Medium</option>
                                                <option value="Kalinga Dark-">Kalinga Dark</option>
                                                <option value="Hazelnut-">Hazelnut</option>
                                                <option value="Mocha-">Mocha</option>
                                                <option value="Hazelnut-Vanilla-">Hazelnut-Vanilla</option>
                                                <option value="Vanilla-">Vanilla</option>
                                                <option value="Butterscotch-">Butterscotch</option>
                                                <option value="Macadamia-">Macadamia</option>
                                                <option value="Cinnamon Nut-">Cinnamon Nut</option>
                                                <option value="Irish Cream-">Irish Cream</option>
                                                <option value="Caramel-">Caramel</option>
                                                <option value="Cookies and Cream-">Cookies and Cream</option>
                                                <option value="Bailey''s Irish Cream-">Bailey''s Irish Cream</option>
                                                <option value="Double Chocolate- ">Double Chocolate</option>

                                            </select>
                                        </th>
                                        <th id="quantity">
                                            <input type="text" name="beans[]" placeholder="enter quantity">
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
                                    <td><input type="submit" name="abc" value="Send" class="btn btn-primary"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="addbtn black circular" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </main>

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