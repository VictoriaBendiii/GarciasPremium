<?php include '../includes/connection.php';
include '../includes/header.php';
include 'update.php'; ?>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="divider"></div>
        <ul class="nav menu">
           <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Delivery</a></li>
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
            <button class="btn btn-primary active" onclick="location.href='supplier.php'"
                style="width:33.3%; border-radius: 30px;">Supplier</button>
            <button onclick="location.href='addsupplier.php'" style="width:33.3%; border-radius: 30px;">Add Supplier</button>
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
                    $sql_supplier = "SELECT * from supplier";
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
                                        <?php
                                        if ($row["status"] == "deactivated") { 
                                            ?>
                                        <a href="update.php?activate=<?php echo $row['supplierid']; ?>"
                                            class="btn btn-info"> Activate </a>
                                        <?php 
                                        }
                                        else if ($row["status"] == "active") { ?>
                                        <a href="update.php?deactivate=<?php echo $row['supplierid']; ?>"
                                            class="btn btn-warning"> Deactivate </a>
                                        <?php
                                                                             }
                                            ?>                                           
                                        <a href="#edit<?php echo $row['supplierid'];?>" data-toggle="modal"
                                            class="btn btn-success" data-toggle="modal">Edit</a>

                                        <!-- Modal -->
                                        <div id="edit<?php echo $row['supplierid']; ?>" class="modal fade"
                                            role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit Supplier</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="editsupplier.php">
                                                            <div class="form-group">
                                                                <input type="hidden" name="supplierid"
                                                                    value="<?php echo $row['supplierid']; ?>">
                                                                <label>Supplier Name</label>
                                                                <input type="text" name="supplier_name"
                                                                    class="form-control"
                                                                    value="<?php echo $row['supplier_name']; ?>"
                                                                    placeholder="Enter Supplier Name">
                                                                <label>Supplier Contact Person</label>
                                                                <input type="text" name="supplier_contact_person"
                                                                    class="form-control"
                                                                    value="<?php echo $row['supplier_contact_person']; ?>"
                                                                    placeholder="Enter Contact Person Full Name">
                                                                <label>Contact Number</label>
                                                                <input type="text" class="form-control"
                                                                    id="contact_number" name="contact_number"
                                                                    placeholder="Contact Number"
                                                                    value="<?php echo $row['contact_number']; ?>"
                                                                    maxlength="13" minlength="13" required>
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" id="address"
                                                                    name="address" placeholder="Address"
                                                                    value="<?php echo $row['address']; ?>">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="edit_supplier"
                                                                    id="edit_supplier ">Update</button>

                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End of Modal -->

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
