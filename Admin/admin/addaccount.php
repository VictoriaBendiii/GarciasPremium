<!DOCTYPE html>
<?php include 'connection.php'; ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garcias Premium Coffee</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

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
            <li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            <li><a href="product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
            <li><a href="notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
            <li><a href="adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Admin Deliveries</a></li>
            <li><a href="inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
            <li><a href="branch.php"><em class="fa fa-clone">&nbsp;</em> Branch Stock Request </a></li>
            <li><a href="addproduct.php"><em class="fa fa-toggle-off">&nbsp;</em> Add Product</a></li>
            <li class="active"><a href="addaccount.php"><em class="fa fa-clone">&nbsp;</em> Add Account </a></li>
            <li><a href="../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Add Account</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Account</h1>
            </div>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                    <form id="contact-form" class="form" action="adduser.php" method="POST" role="form">
                        <div class="form-group">
                            <label class="form-label" for="name">Username</label>
                            <input type="text" class="form-control" id="name" name="username" placeholder="Username"
                                tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Last Name" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="First Name" tabindex="1">
						</div>
						<div class="form-group">
                            <label class="form-label" for="middlename">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename"
                                placeholder="First Name" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number"
                                placeholder="Contact Number" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="usertype">User type</label>
                            <select class="form-control" id="usertype" name="usertype">
								<option value="admin">Admin</option>
                                <option value="subadmin1">Sub-admin Market</option>
                                <option value="subadmin2">Sub-admin Porta</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-start-order" name="add_user" id="add_user">Submit</button>
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

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
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

</body>

</html>