<?php include '../includes/connection.php';
include '../includes/header.php';
include 'adduser.php';
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
                    <li><a href="accounts.php">Accounts</a></li>
                    <li class="active">Add Accounts</li>
                </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Account</h1>
            </div>
        </div>
        <!--/.row-->
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
        <div class="btn-group" style="width:100%">
                <button onclick="location.href='accounts.php'" style="width:33.3%; border-radius: 30px;">Accounts</button>
                <button class="btn btn-primary active" onclick="location.href='addaccount.php'" style="width:33.3%; border-radius: 30px;">Add Accounts</button>
            </div>
            <br><br>

        <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                    <form id="contact-form"  class="form" action="adduser.php" method="POST" role="form">
                        <div class="form-group">
                            <label class="form-label" for="name">Username</label>
                            <input type="text" class="form-control" id="name" name="username" placeholder="Username"
                                tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password"  autocomplete="new-password" class="form-control" id="password" name="password"
                                placeholder="Password" tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password" tabindex="1" required>
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
                                placeholder="Middle Name" tabindex="1">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="contact_number">Contact Number</label>
                            <input type="text" maxlength="13" class="form-control" id="contact_number" name="contact_number"
                                placeholder="Contact Number" tabindex="1" >
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                tabindex="1">
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
                            <button type="submit" class="btn btn-start-order" name="add_user"
                                id="add_user">Submit</button>
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

     <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/chart.min.js"></script>
    <script src="../js/chart-data.js"></script>
    <script src="../js/easypiechart.js"></script>
    <script src="../js/easypiechart-data.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/custom.js"></script>
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
    <script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>

<script>
    var contact_number = document.getElementById("contact_number").value;
        

    function checkNumber() {
        if (contact_number.length != 13) {
            contact_number.setCustomValidity("Please input 13 digit contact number!");
        } else {
            contact_number.setCustomValidity('');
        }
    }

    contact_number.onchange = checkNumber;
    contact_number.onkeyup = checkNumber;
    </script>

</body>

</html>