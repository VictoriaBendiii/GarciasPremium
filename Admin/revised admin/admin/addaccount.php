<?php 
include 'connection.php'; 
include 'template/accounthead.php';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Add Account</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Account</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                <form id="contact-form" class="form" action="adduser.php" method="POST" role="form">
                    <div class="form-group">
                        <label class="form-label" for="name">Username</label>
                        <input type="text" class="form-control" id="name" name="username" placeholder="Username"
                               tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Password" tabindex="1" required>
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
                               placeholder="First Name" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number"
                               placeholder="Contact Number" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Email" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usertype">User type</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option value="admin">Admin</option>
                            <option value="subadmin1">Sub-admin Market</option>
                            <option value="subadmin2">Sub-admin Porta</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-start-order" name="add_user" id="add_user">Submit</button>
                    </div>
                </form>
            </div>


        </div>



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

        <?php 
        include 'template/footer.php';
        ?>
