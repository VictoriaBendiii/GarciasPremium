<!DOCTYPE html>
<?php include '../includes/connection.php'; ?>
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
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
            <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
            <li><a href="../notification/notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
            <li><a href="../deliveries/adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Deliveries</a></li>
            <li><a href="../inventory/inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
            <li><a href="../branch/branch.php"><em class="fa fa-clone">&nbsp;</em> Stock Request </a></li>
            <li><a href="../product/accounts.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
            <li><a href="../accounts/addaccount.php"><em class="fa fa-toggle-off">&nbsp;</em> Accounts</a></li>
            <li class="active"><a href="../supplier/addsupplier.php"><em class="fa fa-clone">&nbsp;</em> Suppliers </a></li>
            <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add Supplier</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Supplier</h1>
            </div>
        </div>
        <!--/.row-->
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='supplier.php'" style="width:33.3%">Supplier</button>
                <button class="btn btn-primary active" onclick="location.href='addsupplier.php'" style="width:33.3%">Add Supplier</button>
            </div>
            <br><br>


        <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                    <form id="contact-form" class="form" action="process.php" method="POST" role="form">
                        <div class="form-group">
                            <label class="form-label" for="name">Supplier Name</label>
                            <input type="text" class="form-control" id="name" name="supplier_name"
                                placeholder="supplier_name" tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_person">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person"
                                placeholder="Supplier Contact Person" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_number">Contact Number</label>
                            <input type="text" maxlength="11" class="form-control" id="contact_number"
                                name="contact_number" placeholder="Contact Number: 09123456789" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Supplier Address" tabindex="1">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-start-order" name="add_supplier"
                                id="add_supplier">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
        <!--/.row-->

    </div>
    <!--/.row-->
    </div>
    <!--/.main-->

    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/chart.min.js"></script>
    <script src="../js/chart-data.js"></script>
    <script src="../js/easypiechart.js"></script>
    <script src="../js/easypiechart-data.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/custom.js"></script>
    <script>
    window.onload = function() {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
    </script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script>
    (function($, window, document, undefined) {

        'use strict';

        var $html = $('html');

        $html.on('click.ui.dropdown', '.js-dropdown', function(e) {
            e.preventDefault();
            $(this).toggleClass('is-open');
        });

        $html.on('click.ui.dropdown', '.js-dropdown [data-dropdown-value]', function(e) {
            e.preventDefault();
            var $item = $(this);
            var $dropdown = $item.parents('.js-dropdown');
            $dropdown.find('.js-dropdown__input').val($item.data('dropdown-value'));
            $dropdown.find('.js-dropdown__current').text($item.text());
        });

        $html.on('click.ui.dropdown', function(e) {
            var $target = $(e.target);
            if (!$target.parents().hasClass('js-dropdown')) {
                $('.js-dropdown').removeClass('is-open');
            }
        });

    })(jQuery, window, document);
    </script>
    <script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>

    <script>
    var contact_number = document.getElementById("contact_number").value;


    function checkNumber() {
        if (contact_number.length != 11) {
            contact_number.setCustomValidity("Please input 11 digit contact number!");
        } else {
            contact_number.setCustomValidity('');
        }
    }

    contact_number.onchange = checkNumber;
    contact_number.onkeyup = checkNumber;
    </script>
    

</body>

</html>