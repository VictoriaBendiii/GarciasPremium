<?php
    // accept or reject
    if(isset($_GET['accept'])){
        
        $id = $_GET['accept'];

        
        $update_request_status = "UPDATE order_request SET status = 'accepted' WHERE idnumber = $id";
        
        

        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }
    if(isset($_GET['reject'])){
        
        $id = $_GET['reject'];
        
        
        $update_request_status = "UPDATE order_request SET status = 'rejected' WHERE idnumber = $id";
        
        mysqli_query($conn, $update_request_status);
        
        if(mysqli_affected_rows($conn) == 1){
            
            $updatestat = 1;
            
        }else{
            
            $updatestat = '';
        }
    }
?>
