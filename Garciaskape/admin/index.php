<?php
session_start();
// Check if there is a user logged in
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../index.php?session_expired=1");
}
include 'includes/connection.php';
include 'inventory/query.php';
?>
<!DOCTYPE html>
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
<style type="text/css">
   #chart-container {
        margin-left: 250px;
        position: relative;
        width: 80vw;
        height: 10vh;
</style>
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
                    <p> <?php $f_name = $_SESSION['firstname']; $l_name = $_SESSION['lastname'];  echo "$f_name $l_name "; ?></p>


                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
                <li><a href="inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Total Stocks Remaining <?php echo $row['branch_name']; ?> </h1>
                </div>
            </div><!--/.row-->

            <div class="btn-group" style="width:100%">
                <button class="btn btn-primary active" onclick="location.href='index.php'"; style="width:33.3%; border-radius: 30px;">Market</button>
                <button onclick="location.href='monitoring/subchart.php'"; style="width:33.3%; border-radius: 30px;">Porta</button>
            </div><!--/.row-->



        </div>	<!--/.main-->

    <div id="chart-container">
      <canvas id="mycanvas"></canvas>
    </div>

     <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>

    </body>
</php>
