<?php
if(isset($_POST['abc'])){
    // Authorisation details.
    $username = "aaronferrerquitoriano@gmail.com";
    $hash = "4a95acef14a537bb3d32bc6aad8cb80baa9d18f9ac06b3158f50784e6735c4c6";

    // Config variables. Consult http://api.txtlocal.com/docs for more info.
    $test = "0";

    // Data for text message. This is the text message data.
    $sender = $_POST['sender']; // This is who the message appears to be from.
    $numbers = $_POST['num']; // A single number or a comma-seperated list of numbers
    $messageArray = $_POST['beans'];
    $message = implode(" ", $messageArray);
    // 612 chars or less
    // A single number or a comma-seperated list of numbers
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.txtlocal.com/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); // This is the result from the API
    curl_close($ch);
}
?>

<?php

include '../includes/connection.php';
include '../includes/header.php';
$query = "SELECT * FROM products";

$result1 = mysqli_query($conn, $query);

if (!$result1) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

$query2 = "SELECT * FROM supplier";

$result2 = mysqli_query($conn, $query2);

if (!$result2) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

?>

        <script src="../js/notification.js"></script>

          <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li class="active"><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Delivery</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Delivery</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Delivery</h1>
                </div>
            </div><!--/.row-->

        </div><!--/.row-->

        <main role="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                <!-- Button trigger modal -->
                <button type="button" class="addbtn black circular" data-toggle="modal" data-target="#ModalCenter">
                    REQUEST A DELIVERY TO MARKET
                </button>
                <br> 
                <br>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLongTitle">Request a delivery to Market</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="adeliveries.php">
                                <table align="center">
                                    <tr>
                                        <td>Supplier:</td>
                                        <th id="num">
                                            <select name="num">
                                                <?php while($row1 = mysqli_fetch_array($result2)):;?>
                                                <option value="<?php echo $row1[3];?>"><?php echo $row1[1], " - " , $row1[3];?></option>
                                                <?php endwhile;?>
                                            </select>
                                        </th>  
                                    </tr>
                                </table>
                                <div style="overflow-x:auto;">
                                    <table id="tableDrop">
                                        <tr>                                        
                                            <th>
                                                <h5>COFFEE BEAN</h5>
                                            </th>
                                            <th>
                                                <h5>QUANTITY(kg)</h5>
                                            </th>
                                            <th>
                                                <h5>REMOVE ORDER</h5>
                                            </th>
                                        </tr>

                                        <tr id="dropdowns">                                          
                                            <th id="beans">
                                                <select name="beans[]">
                                                    <?php while($row1 = mysqli_fetch_array($result1)):;?>
                                                    <option value="<?php echo $row1[1], "-";?>"><?php echo $row1[1];?></option>
                                                    <?php endwhile;?>
                                                </select>
                                            </th>
                                            <th id="quantity">
                                                <input type="text" name="beans[]" placeholder="enter quantity">
                                            </th>
                                            <th id="remove">
                                                <input type="button" value="&#10006;" onclick="RemoveOrder()">
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                                <table>
                                    <br>
                                    <tr>
                                        <td><input type="button" onclick="cloneRow()" value="Add Order" class="btn btn-secondary"/></td>
                                        <td><input type="submit" name="abc" value="Send" class="btn btn-primary"/></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="addbtn black circular" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </main>
