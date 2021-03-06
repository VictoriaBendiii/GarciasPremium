<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}
include '../includes/connection.php';
include 'update.php'; ?>
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
           <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li class="active"><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
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
                <li class="active">Supplier</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Supplier</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="btn-group" style="width:100%">
            <button onclick="location.href='supplier.php'" style="width:33.3%; border-radius: 30px;">Supplier</button>
            <button onclick="location.href='addsupplier.php'" style="width:33.3%; border-radius: 30px;">Add Supplier</button>
            <button class="btn btn-primary active" onclick="location.href='deac_supplier.php'" style="width:33.3%; border-radius: 30px;">Deactivated Supplier Accounts</button>
        </div>
        <br><br>
        <!-- ALERT -->
        <?php require_once 'update.php' ?>
        <?php
        if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
        </div>
        <?php endif ?>
        <br>
        <!-- ALERT -->
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $sql_supplier = "SELECT * from supplier WHERE status = 'Deactivated'";
                    $result = mysqli_query($conn, $sql_supplier);
                    ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Supplier Contact Person</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if($result = mysqli_query($conn, $sql_supplier)) {
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                            <tr>
                                <form action="update.php" method="POST">
                                    <td> <?php echo $row["supplier_name"]; ?> </td>
                                    <td> <?php echo $row["supplier_contact_person"]; ?> </td>
                                    <td> <?php echo $row["contact_number"]; ?> </td>
                                    <td> <?php echo $row["address"];?> </td>
                                    <td> <?php echo $row["status"];?> </td>
                                    <td>

                                        <a href="update.php?activate=<?php echo $row['supplierid']; ?>"
                                            class="btn btn-info"> Activate </a>

                                        <a href="update.php?delete=<?php echo $row['supplierid']; ?>"
                                            class="btn btn-danger"> Delete </a>
                                    </td>
                                </form>

                            </tr>
                            <?php
                                    }
                                }
                                ?>
                        </tbody>
                    </table>

                    <!--/.row-->

                </div>
                <!--/.row-->
            </div>
            <!--/.main-->


            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
            </script>
            <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
            <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet"
                type="text/css" />
            <script type="text/javascript">
            $(function() {
                $("#dialog").dialog({
                    modal: true,
                    autoOpen: false,
                    title: "jQuery Dialog",
                    width: 300,
                    height: 150
                });
                $("#btnShow").click(function() {
                    $('#dialog').dialog('open');
                });
            });
            </script>

</body>

</html>
