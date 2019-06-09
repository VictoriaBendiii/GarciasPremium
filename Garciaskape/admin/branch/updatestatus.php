<?php
    // accept or reject
    if(isset($_GET['accept'])){
        
        $id = $_GET['accept'];

        $sql_get1 = "SELECT * FROM order_request WHERE order_requestid=$id";
            $result1 = mysqli_query($conn, $sql_get1);
            $row = mysqli_num_rows($result1);
            $row = mysqli_fetch_array($result1);
            $orderquan = $row['quantity'];
        
        $update_request_status = "UPDATE order_request SET status = 'accepted' WHERE order_requestid = $id";
        
        

        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }
    if(isset($_GET['reject'])){
        
        $id = $_GET['reject'];
        
        
        $update_request_status = "UPDATE order_request SET status = 'rejected' WHERE order_requestid = $id";
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }
?>
