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
                <p><?php $f_name = $_SESSION['firstname']; $l_name = $_SESSION['lastname'];  echo "$f_name $l_name "; ?></p>


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
                <li><a href="../product/product.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li class="active"><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
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
                <button class="btn btn-primary active" onclick="location.href='accounts.php'" style="width:33.3%">Accounts</button>
                <button onclick="location.href='addaccount.php'" style="width:33.3%">Add Accounts</button>
            </div>
            <br><br>

        <div class="row">
            <div class="col-lg-12">
                <?php
				$sql_accounts = "SELECT * from accounts";
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
						if($result = mysqli_query($conn, $sql_accounts)) {
							while($row=mysqli_fetch_array($result)){
					?>
                            <tr>
                                <form action="update.php" method="POST">
                                    <td> <?php echo $row["username"]; ?> </td>
                                    <td> <?php echo $row["firstname"]; ?> </td>
                                    <td> <?php echo $row["lastname"]; ?> </td>
                                    <td> <?php echo $row["user_type"]; ?> </td>
                                    <td> <?php echo $row["contact_number"]; ?> </td>
                                    <td> <?php echo $row["email"];?> </td>
                                    <td> <?php echo $row["status"];?> </td>

                                    <td>
                                        <?php
                                        if ($row["status"] == "Deactivated") { 
                                    ?>
                                        <a href="update.php?activate=<?php echo $row['accountid']; ?>"
                                            class="btn btn-info"> Activate </a>
                                        <?php 
                                    }
                                    else if ($row["status"] == "Active") { ?>
                                        <a href="update.php?deactivate=<?php echo $row['accountid']; ?>"
                                            class="btn btn-warning"> Deactivate </a>
                                        <?php
                                    }
                                    ?>

                                        <a href="#edit<?php echo $row['accountid'];?>" data-toggle="modal"
                                            class="btn btn-success" data-toggle="modal">Edit</a>

                                        <!-- Modal -->
                                        <div id="edit<?php echo $row['accountid']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit Account</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="editaccount.php">
                                                            <div class="form-group">
                                                                <input type="hidden" name="edit_item_id"
                                                                    value="<?php echo $row['accountid']; ?>">
                                                                <label>Username</label>
                                                                <input type="text" name="username" class="form-control"
                                                                    value="<?php echo $row['username']; ?>"
                                                                    placeholder="Enter Username">
                                                                <label>Password</label>
                                                                <input type="text" name="password" class="form-control"
                                                                    value="<?php $decrypt_password=base64_decode($row['password']);
                                                                    echo $decrypt_password; ?>"
                                                                    placeholder="Enter Password">
                                                                <label>Confirm Password</label>
                                                                <input type="text" class="form-control"
                                                                    id="confirm_password" name="confirm_password"
                                                                    placeholder="Password"
                                                                    value="<?php $decrypt_password=base64_decode($row['password']);
                                                                    echo $decrypt_password; ?>" required>
                                                                <label>First Name</label>
                                                                <input type="hidden" name="accountid" id="accountid"
                                                                    class="form-control"
                                                                    value="<?php echo $row['accountid']; ?>">
                                                                <input type="text" name="firstname" id="firstname"
                                                                    class="form-control"
                                                                    value="<?php echo $row['firstname']; ?>"
                                                                    placeholder="Enter First Name">
                                                                <label>Last Name</label>
                                                                <input type="text" name="lastname" class="form-control"
                                                                    value="<?php echo $row['lastname']; ?>"
                                                                    placeholder="Enter Last Name">
                                                                <label>User type</label>
                                                                <select class="form-control" name="usertype"
                                                                    class="form-control">
                                                                    <option value="<?php echo $row['user_type']; ?>"
                                                                        selected>
                                                                        <?php 
                                                                        if ($row['user_type'] == 'sub-admin1') {
                                                                            echo 'Sub-admin Market';
                                                                        } else if ($row['user_type'] == 'sub-admin2') {
                                                                            echo 'Sub-admin Porta';
                                                                        }  else if ($row['user_type'] == 'admin') {
                                                                            echo 'Admin';
                                                                        } ?></option>
                                                                    <option value="admin">Admin</option>
                                                                    <option value="subadmin1">Sub-admin Market</option>
                                                                    <option value="subadmin2">Sub-admin Porta</option>
                                                                </select>
                                                                <label>Contact Number</label>
                                                                <input type="text" maxlength="11" class="form-control"
                                                                    id="contact_number" name="contact_number"
                                                                    placeholder="Contact Number"
                                                                    value="<?php echo $row['contact_number']; ?>"
                                                                    maxlength="11">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" id="email"
                                                                    name="email" placeholder="Email"
                                                                    value="<?php echo $row['email']; ?>">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="edit_account"
                                                                    id="edit_account ">Update</button>

                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End of Modal -->

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