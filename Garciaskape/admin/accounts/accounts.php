<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../includes/connection.php';
include 'update.php';
?>

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
        <button class="btn btn-primary active" onclick="location.href='accounts.php'"
            style="width:33.3%; border-radius: 30px; ">Accounts</button>
        <button onclick="location.href='addaccount.php'" style="width:33.3%;border-radius: 30px;">Add Accounts</button>
        <button onclick="location.href='deac_accounts.php'" style="width:33.3%; border-radius: 30px; ">Deactivated
            Accounts</button>
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
                $sql_accounts = "SELECT * from accounts WHERE status='Active'";
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
                                <td>
                                    <?php echo $row["username"]; ?> </td>
                                <td>
                                    <?php echo $row["firstname"]; ?> </td>
                                <td>
                                    <?php echo $row["lastname"]; ?> </td>
                                <td>
                                    <?php echo $row["user_type"]; ?> </td>
                                <td>
                                    <?php echo $row["contact_number"]; ?> </td>
                                <td>
                                    <?php echo $row["email"]; ?> </td>
                                <td>
                                    <?php echo $row["status"]; ?> </td>

                                <td>
                                    <?php
                                        if ($row["status"] == "Deactivated") {
                                            ?>
                                    <a href="update.php?activate=<?php echo $row['accountid']; ?>" class="btn btn-info">
                                        Activate </a>
                                    <?php
                                        } elseif ($row["status"] == "Active") {
                                            ?>
                                    <a href="update.php?deactivate=<?php echo $row['accountid']; ?>"
                                        class="btn btn-warning"> Deactivate </a>
                                    <?php
                                        } ?>

                                    <a href="#edit<?php echo $row['accountid']; ?>" data-toggle="modal"
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
                                                            <span id="popover-username"
                                                                class="popuser hide pull-right block-help"><i
                                                                    class="fa fa-info-circle text-danger"
                                                                    aria-hidden="true"></i> Username must not contain
                                                                any special characters</span>
                                                            <input type="text" id="username" name="username"
                                                                class="username form-control"
                                                                value="<?php echo $row['username']; ?>"
                                                                placeholder="Enter Username">
                                                            <label>First Name</label>
                                                            <span id="popover-username"
                                                                class="popfirst hide pull-right block-help"><i
                                                                    class="fa fa-info-circle text-danger"
                                                                    aria-hidden="true"></i> First name must not contain
                                                                any special characters</span>
                                                            <input type="text" name="firstname" id="firstname"
                                                                class="firstname form-control"
                                                                value="<?php echo $row['firstname']; ?>"
                                                                placeholder="Enter First Name">
                                                            <label>Last Name</label>
                                                            <span id="popover-username"
                                                                class="poplast hide pull-right block-help"><i
                                                                    class="fa fa-info-circle text-danger"
                                                                    aria-hidden="true"></i> Last name must not contain
                                                                any special characters</span>
                                                            <input type="text" name="lastname" class="lastname form-control"
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
                                                                        } elseif ($row['user_type'] == 'sub-admin2') {
                                                                            echo 'Sub-admin Porta';
                                                                        } elseif ($row['user_type'] == 'admin') {
                                                                            echo 'Admin';
                                                                        } ?></option>
                                                                <option value="admin">Admin</option>
                                                                <option value="subadmin1">Sub-admin Market</option>
                                                                <option value="subadmin2">Sub-admin Porta</option>
                                                            </select>
                                                            <label>Contact Number</label>
                                                            <span id="popover-cnumber"
                                                                class="popnum hide pull-right block-help"><i
                                                                    class="fa fa-info-circle text-danger"
                                                                    aria-hidden="true"></i> Enter 11 digit phone number
                                                            </span>
                                                            <input type="text" class="con_num form-control" id="contact_number"
                                                                name="contact_number" minlength="13" maxlength="13"
                                                                placeholder="+639XXXXXXXXX"
                                                                value="<?php echo $row['contact_number']; ?>" required>
                                                            <label>Email</label>
                                                            <span id="popover-username"
                                                                class="popemail hide pull-right block-help"><i
                                                                    class="fa fa-info-circle text-danger"
                                                                    aria-hidden="true"></i>Please use the proper format of an email</span>
                                                            <input type="email" class="email form-control" id="email"
                                                                name="email" placeholder="Email"
                                                                value="<?php echo $row['email']; ?>">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="sub btn btn-success"
                                                                id="submit" name="edit_account"
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

        <script>
        $(document).ready(function() {
            $('.username').blur(function() {
                var regex =
                    /\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\?|\/|\""|\;|\:|\s/;
                var isUserNameCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.popuser').toggleClass('hide', !isUserNameCorrect);
                $('.sub').prop('disabled', isUserNameCorrect);
            });

            $('.firstname').blur(function() {
                var regex =
                    /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
                var isFirstnameCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.popfirst').toggleClass('hide', !isFirstnameCorrect);
                $('.sub').prop('disabled', isFirstnameCorrect);
            });
            $('.lastname').blur(function() {
                var regex =
                    /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
                var isLastnameCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.poplast').toggleClass('hide', !isLastnameCorrect);
                $('.sub').prop('disabled', isLastnameCorrect);
            });
            $('.email').blur(function() {
                var regex =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var isEmailCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.popemail').toggleClass('hide', isEmailCorrect);
                $('.sub').prop('disabled', !isEmailCorrect);
            });
            $('.con_num').blur(function() {
                var regex = /((\+63)|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/;
                var isNumberCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.popnum').toggleClass('hide', isNumberCorrect);
                $('.sub').prop('disabled', !isNumberCorrect);
            });
        });
        </script>
    </body>

</html>
