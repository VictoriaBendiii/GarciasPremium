<?php include '../includes/connection.php'; ?>
<?php 

//fetch query
$sql = "SELECT products.productname,products.productid, stock.quantity as stock, branch.branchid, products.status
from ((stock left join products on stock.productid = products.productid) 
left join branch on stock.branchid = branch.branchid) where (branch.branchid = 1  OR branch.branchid = 3) AND products.status = 'active'; ";
$result = mysqli_query($conn, $sql);

//update query
if(isset($_POST['active'])){

    $productid = $_POST['productid'];
    $updateproduct =("UPDATE products SET status = 'archive' WHERE products.productid='$productid'");
    mysqli_query($conn, $updateproduct);
}
session_start();
?>


<!DOCTYPE HTML>
<html lang="en">

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
                <li ><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li ><a href="../notification/notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li ><a href="../deliveries/adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Deliveries</a></li>
                <li class="active"><a href="inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-clone">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-clone">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Inventory</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inventory</h1>
                </div>

            </div><!--/.row-->
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='inventory.php'"; style="width:33.3%">Market</button>
                <button onclick="location.href='inventoryporta.php'"; style="width:33.3%">Porta</button>
                <button onclick="location.href='inventoryarchive.php'"; style="width:33.3%">Archived</button>
            </div>

            <br>
            <br> 
            <div class="bs-example">
                <!-- Modal HTML -->
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Archive Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to archive this product?</p>
                                <p class="text-warning"><small>Product will be move in archived products</small></p>
                            </div>
                            <div class="modal-footer">
                                <form action ="" method="POST">
                                    <input type="submit" name="active" class="btn btn-success btn-sm" >Archive</a>
                                <a href="" class="btn btn-danger btn-sm" data-dismiss="modal">Close</a>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Total Stock (kg)</th>
                    <th>Action</th>
                </tr>
                <tr>


                    <?php

                    If($result->num_rows > 0)
                    {
                        while($row=mysqli_fetch_array($result))
                        {  

                    ?>



                    <td><?php echo $row['productname']; ?></td> 
                    <td <?php if($row['stock'] <= 50): ?> style="background-color:red;" <?php endif; ?>><?php echo $row['stock']; ?></td> 
                    <td> <button type="submit" id = "archive" onclick="confirmation() " class="addbtn green " name="archive" > <?php echo $row['status']; ?></button>
                    </td> 
                </tr>

                <?php

                        }
                    }
                ?>

                </tr>
            </table>
        </div>

    </div><!--/.row-->
</div>	<!--/.main-->


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/chart.min.js"></script>
<script src="../js/chart-data.js"></script>
<script src="../js/easypiechart.js"></script>
<script src="../js/easypiechart-data.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/custom.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#archive").click(function(){
            $("#myModal").modal('show');
        });
    });


</script>
<script>

    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };

    jQuery('#yesarchive').click(function(){
        jQuery.ajax({
            type:'POST',
            url:'invetory.php',
            data:{'updated':true},
            dataType:'json'
            success:function(data){
            alert(data.error);
        }
                    });
    });
</script>


</body>
</html>