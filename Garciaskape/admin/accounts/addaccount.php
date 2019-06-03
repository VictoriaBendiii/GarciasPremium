<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../includes/connection.php';
include 'adduser.php';
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
            <li><a href="addaccount.php">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Accounts</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Accounts</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="btn-group" style="width:100%">
        <button onclick="location.href='accounts.php'" style="width:33.3%; border-radius: 30px; ">Accounts</button>
        <button class="btn btn-primary active" onclick="location.href='addaccount.php'"
            style="width:33.3%;border-radius: 30px;">Add Accounts</button>
        <button onclick="location.href='deac_accounts.php'" style="width:33.3%; border-radius: 30px; ">Deactivated
            Accounts</button>
    </div>
    <br><br>
    <!-- ALERT -->
    <?php require_once 'adduser.php' ?>
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
                <form id="contact-form" class="form" action="adduser.php" method="POST" role="form">
                    <div class="form-group">
                        <label class="form-label" for="name">Username</label>
                        <span id="popover-username" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Username must not contain
                            any special characters</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <span id="popover-password-top" class="hide pull-right block-help">
                            <i class="fa fa-info-circle text-danger" aria-hidden="true"> </i> Enter a strong password
                        </span>
                        <input type="password" autocomplete="new-password" class="form-control input-md" id="password"
                            name="password" placeholder="Password" tabindex="1" data-placement="bottom"
                            data-toggle="popover" data-container="body" data-html="true" required>
                        <div id="popover-password">
                            <p>Password Strength: <span id="result"> </span></p>
                            <div class="progress">
                                <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                <li class=""><span class="low-upper-case"><i class="fa fa-thumbs-down"
                                            aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
                                <li class=""><span class="one-number"><i class="fa fa-thumbs-down"
                                            aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
                                <li class=""><span class="eight-character"><i class="fa fa-thumbs-down"
                                            aria-hidden="true"></i></span> &nbsp; Atleast 8 Character</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Confirm Password</label>
                        <span id="popover-cpassword" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Password don't
                            match</span>
                        <input type="password" class="form-control input-md" id="confirm_password"
                            name="confirm_password" placeholder="Confirm Password" tabindex="1" required>

                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lastname">Last Name</label>
                        <span id="popover-lastname" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Last name must not contain
                            any special characters</span>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"
                            tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="firstname">First Name</label>
                        <span id="popover-firstname" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> First name must not
                            contain any special characters</span>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"
                            tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="middlename">Middle Name</label>
                        <span id="popover-middlename" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Middle name must not
                            contain any special characters</span>
                        <input type="text" class="form-control" id="middlename" name="middlename"
                            placeholder="Middle Name" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <span id="popover-cnumber" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter 11 digit phone
                            number </span>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-secondary" disabled>+63</button>
                            </span>
                            <input type="text" class="form-control" id="contact_number" name="contact_number"
                                minlength="10" maxlength="10" placeholder="9XXXXXXXXX" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <span id="popover-email" class="hide pull-right block-help"><i
                                class="fa fa-info-circle text-danger" aria-hidden="true"></i> Enter correct email
                            format</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usertype">User type</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="admin">Admin</option>
                            <option value="sub-admin1">Sub-admin Market</option>
                            <option value="sub-admin2">Sub-admin Porta</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit" class="btn btn-start-order" name="add_user"
                            id="add_user">Submit</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
    <!--/.row-->

</div>
<!--/.row-->

<!--/.main-->



<script>
$(document).ready(function() {
    $('#password').keyup(function() {
        var password = $('#password').val();
        if (checkStrength(password) == false) {
            $("#submit").attr('disabled', 'disabled');
        }
    });
    $('#confirm_password').blur(function() {
        if ($('#password').val() !== $('#confirm_password').val()) {
            $('#popover-cpassword').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $('#popover-cpassword').addClass('hide');
            $("#submit").removeAttr('disabled');
        }
    });
    $('#username').blur(function() {
        var regex =
            /\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\?|\/|\""|\;|\:|\s/;
        if ($('#username').val().match(regex)) {
            $('#popover-username').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $('#popover-username').addClass('hide');
            $('#sign-up').attr('disabled', false);
            $("#submit").removeAttr('disabled');
        }
    });
    $('#lastname').blur(function() {
        var regex =
            /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
        if ($('#lastname').val().match(regex)) {
            $('#popover-lastname').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $('#popover-lastname').addClass('hide');
            $('#sign-up').attr('disabled', false);
            $("#submit").removeAttr('disabled');
        }
    });
    $('#firstname').blur(function() {
        var regex =
            /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
        if ($('#firstname').val().match(regex)) {
            $('#popover-firstname').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $('#popover-firstname').addClass('hide');
            $("#submit").removeAttr('disabled');
        }
    });
    $('#middlename').blur(function() {
        var regex =
            /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
        if ($('#middlename').val().match(regex)) {
            $('#popover-middlename').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        } else {
            $('#popover-middlename').addClass('hide');
            $("#submit").removeAttr('disabled');
        }
    })
    $('#contact_number').blur(function() {
        var regex = /(\+639)\d{9}/;
        if ($('#contact_number').val().match(regex)) {
            $('#popover-cnumber').addClass('hide');
            $("#submit").removeAttr('disabled');
        } else {
            $('#popover-cnumber').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        }
    });
    $('#password').keyup(function() {
        var password = $('#password').val();
        if (checkStrength(password) == false) {
            $("#submit").attr('disabled', 'disabled');
        }
    });
    $('#email').blur(function() {
        var regex =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if ($('#email').val().match(regex)) {
            $('#popover-email').addClass('hide');
            $("#submit").removeAttr('disabled');
        } else {
            $('#popover-email').removeClass('hide');
            $("#submit").attr('disabled', 'disabled');
        }
    });
    function checkStrength(password) {
        var strength = 0;
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 2;
            $('.low-upper-case').addClass('text-success');
            $('.low-upper-case i').removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');
            $('#popover-password-top').addClass('hide');
        } else {
            $('.low-upper-case').removeClass('text-success');
            $('.low-upper-case i').addClass('fa fa-thumbs-down').removeClass('fa fa-thumbs-up');
            $('#popover-password-top').removeClass('hide');
        }
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
            strength += 1;
            $('.one-number').addClass('text-success');
            $('.one-number i').removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');
            $('#popover-password-top').addClass('hide');
        } else {
            $('.one-number').removeClass('text-success');
            $('.one-number i').addClass('fa fa-thumbs-down').removeClass('fa fa-thumbs-up');
            $('#popover-password-top').removeClass('hide');
        }
        if (password.length > 7) {
            strength += 1;
            $('.eight-character').addClass('text-success');
            $('.eight-character i').removeClass('fa fa-thumbs-down').addClass('fa fa-thumbs-up');
            $('#popover-password-top').addClass('hide');
        } else {
            $('.eight-character').removeClass('text-success');
            $('.eight-character i').addClass('fa fa-thumbs-down').removeClass('fa fa-thumbs-up');
            $('#popover-password-top').removeClass('hide');
        }
        if (strength < 2) {
            $('#result').removeClass()
            $('#password-strength').addClass('progress-bar-danger');
            $('#result').addClass('text-danger').text('Very Weak');
            $('#password-strength').css('width', '10%');
        } else if (strength == 2) {
            $('#result').addClass('good');
            $('#password-strength').removeClass('progress-bar-danger');
            $('#password-strength').addClass('progress-bar-warning');
            $('#result').addClass('text-warning').text('Weak')
            $('#password-strength').css('width', '60%');
            return 'Weak'
        } else if (strength == 4) {
            $('#result').removeClass()
            $('#result').addClass('strong');
            $('#password-strength').removeClass('progress-bar-warning');
            $('#password-strength').addClass('progress-bar-success');
            $('#result').addClass('text-success').text('Strength');
            $('#password-strength').css('width', '100%');
            return 'Strong'
        }
    }
});
</script>
