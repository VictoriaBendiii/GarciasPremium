<?php 
    session_start();

    include('../includes/connection.php');

    // accept or reject

    if(isset($_REQUEST['accept'])){
        
        $accept_stat = $_REQUEST['accept'];
        $orderid = $_REQUEST['orderid'];
        
        $update_request_status = "UPDATE orders SET status = '$accept_stat' WHERE orderid = $orderid";
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            echo '1';
        }else{
            echo '0';
        }
    }


    if(isset($_REQUEST['reject'])){
        
        $accept_stat = $_REQUEST['reject'];
        $orderid = $_REQUEST['orderid'];
        
        $update_request_status = "UPDATE orders SET status = '$accept_stat' WHERE orderid = $orderid";
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            echo '1';
        }else{
            echo '0';
        }
    }

?>
