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
include 'addprod.php';?>
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


        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
        <!-- <link href="../css/add.css" rel="stylesheet"> -->
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
                    <p> <?php $f_name = $_SESSION['firstname']; $l_name = $_SESSION['lastname'];  echo "$f_name $l_name "; ?></p>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="divider"></div>
        <ul class="nav menu">
                <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li class="active"><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="product.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li><a href="product.php">Product</a></li>
            <li class="active">Add Product</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="btn-group" style="width:100%">
        <button onclick="location.href='product.php'" style="width:33.3%; border-radius: 30px;">Products</button>
        <button class="btn btn-primary active" onclick="location.href='addproduct.php'"
            style="width:33.3%; border-radius: 30px;">Add
            Product</button>
        <button onclick="location.href='archivedproducts.php'" style="width:33.3%; border-radius: 30px;">Archived
            Products</button>
    </div>
    <br><br>

    <!-- ALERT -->
    <?php require_once 'addprod.php' ?>
    <?php
         if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
    </div>
    <?php endif ?>
    <!-- ALERT -->

    <div class="row">
        <div class="col-lg-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                <form id="contact-form" class="form" action="addprod.php" method="POST" role="form">
                    <div class="form-group">
                        <label class="form-label" for="name">Product Name</label>
                        <span id="popover-product" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Product name should not contain any special character.
                        </span>
                        <input type="text" class="form-control" id="productname" name="prodname"
                            placeholder="Product Name" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="branchid">Branch</label>
                        <input type="text" class="form-control" value="Market and Porta" tabindex="1" disabled>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="sub btn btn-start-order" name="add_prod"
                            id="add_prod">Submit</button>
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
<script>
    $(document).ready(function() {
    $('#productname').blur(function() {
        var regex = /[&\/\\#,+=()@^$~%.'":*!?<>{}]/;
        if ($('#productname').val().match(regex)) {
            $('#popover-product').removeClass('hide');
            $("#add_prod").attr('disabled', 'disabled');
        } else {
            $('#popover-product').addClass('hide');
            $("#add_prod").removeAttr('disabled');
        }
    });
});
</script>
