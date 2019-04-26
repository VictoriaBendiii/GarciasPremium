<?php include '../includes/connection.php'; 
include '../includes/header.php';
include 'update.php';
?>


    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="divider"></div>
        <ul class="nav menu">
           
                <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Delivery</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li class="active"><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="accounts.php">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Accounts</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Accounts</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="btn-group" style="width:100%">
                <button onclick="location.href='accounts.php'" style="width:33.3%; border-radius: 30px; ">Accounts</button>
                <button onclick="location.href='addaccount.php'" style="width:33.3%;border-radius: 30px;">Add Accounts</button>
            <button class="btn btn-primary active" onclick="location.href='deac_accounts.php'" style="width:33.3%; border-radius: 30px; ">Deactivated Accounts</button>
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
        <!-- ALERT -->
        
        <div class="row">
            <div class="col-lg-12">
                <?php
                $sql_accounts = "SELECT * from accounts WHERE status='Deactivated'";
                $result = mysqli_query($conn, $sql_accounts);
        ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Type</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                        if ($result = mysqli_query($conn, $sql_accounts)) {
                            while ($row=mysqli_fetch_array($result)) {
                                ?>
                            <tr>
                                <form action="update.php" method="POST">
                                    <td> <?php echo $row["username"]; ?> </td>
                                    <td> <?php echo $row["firstname"]; ?> </td>
                                    <td> <?php echo $row["lastname"]; ?> </td>
                                    <td> <?php echo $row["user_type"]; ?> </td>
                                    <td> <?php echo $row["contact_number"]; ?> </td>
                                    <td> <?php echo $row["email"]; ?> </td>
                                    <td> <?php echo $row["status"]; ?> </td>

                                    <td>
                                        
                                        <a href="update.php?activate=<?php echo $row['accountid']; ?>"
                                        class="btn btn-info"> Activate </a> 
                                        
                                        
                                        <a href="update.php?delete=<?php echo $row['accountid']; ?>"
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
        </div>

</body>

</html>