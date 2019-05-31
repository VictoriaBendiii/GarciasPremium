<?php


    // accept or reject

    if(isset($_REQUEST['accept'])){
        
        $accept_id = $_REQUEST['accept'];
      
        
        $update_request_status = "UPDATE order_request SET status = 'accepted' WHERE order_requestid = $accept_id";
        
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }


    if(isset($_REQUEST['reject'])){
        
        $accept_id = $_REQUEST['reject'];
     
        
        $update_request_status = "UPDATE order_request SET status = 'rejected' WHERE order_requestid = $accept_id";
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }

?>
