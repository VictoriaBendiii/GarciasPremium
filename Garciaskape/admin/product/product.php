<!DOCTYPE html>
<?php include '../includes/connection.php'; ?>
<?php include 'update.php'; ?>

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="../product/product.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-toggle-off">&nbsp;</em> Suppliers</a></li>
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
                    <li class="active">Product</li>
                </ol>
            </div>
            <!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product</h1>
                </div>
            </div>
            <!--/.row-->
            <div class="btn-group" style="width:100%">
                <button class="btn btn-primary active" onclick="location.href='product.php'" style="width:33.3%">Product</button>
                <button onclick="location.href='addproduct.php'" style="width:33.3%">Add Product</button>
            </div>
            <br><br>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $sql_product = "SELECT * from products";
                    $result = mysqli_query($conn, $sql_product);
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if($result = mysqli_query($conn, $sql_product)) {
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <form action="update.php" method="POST">
                                        <td> <?php echo $row["productname"]; ?> </td>


                                        <td>


                                            <a href="#edit<?php echo $row['productid'];?>" data-toggle="modal"
                                               class="btn btn-success" data-toggle="modal">Edit</a>

                                            <!-- Modal -->
                                            <div id="edit<?php echo $row['productid']; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Edit Product</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="editproduct.php">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="productid"
                                                                           value="<?php echo $row['productid']; ?>">
                                                                    <label>Product Name</label>
                                                                    <input type="text" name="productname" class="form-control"
                                                                           value="<?php echo $row['productname']; ?>"
                                                                           placeholder="Enter Product Name">

                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success"
                                                                            name="edit_product"
                                                                            id="edit_product ">Update</button>

                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- End of Modal -->

                                            <a href="update.php?delete=<?php echo $row['productid']; ?>"
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