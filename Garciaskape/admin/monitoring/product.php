<?php
session_start();
include '../includes/connection.php';
include '../includes/header.php';
include '../includes/sidebar.php';
?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Product Monitoring</li>

                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Monitoring</h1>
                </div>
            </div><!--/.row-->

            <div class="btn-group" style="width:100%">
                <button onclick="location.href='market.php'" style="width:50%; border-radius: 30px;">Market</button>
                <button onclick="location.href='porta.php'" style="width:50%;  border-radius: 30px;">Porta</button>
            </div>





</body>
</html>