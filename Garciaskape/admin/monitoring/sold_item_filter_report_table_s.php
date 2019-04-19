<?php  
include '../includes/connection.php';

if(isset($_POST["from_date"], $_POST["to_date"]))  
{   
    $output = '';  
    $query = "SELECT products.productname as sname, branch.branchid, branch.branch_name as bsname, solditem.quantity as sqty, accounts.firstname as asname, solditem.time as t, solditem.status
from (((solditem left join products on solditem.productid = products.productid)
left join branch on solditem.branchid = branch.branchid)
left join accounts on solditem.accountid = accounts.accountid) 
where branch.branchid = 2 and solditem.time BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ";  

    $result = mysqli_query($conn, $query);  
    $output .= '  
           <table class="table table-bordered">  
                <tr>  

                               <th width="10%">Branch</th>  
                               <th width="15%">Account Name</th>  
                               <th width="25%">Product Name</th>  
                               <th width="10%">Quantity (in kg)</th>
                               <th width="20%">Time Sold</th> 

                </tr>  
      ';  
    if(mysqli_num_rows($result) > 0)  
    {  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                     <tr>  
                          <td>'. $row["bsname"] .'</td>  
                          <td>'. $row["asname"] .'</td>  
                          <td>'. $row["sname"] .'</td>    
                          <td>'. $row["sqty"] .'</td>  
                          <td>'. $row["t"] .'</td>

                     </tr>  
                ';  
        }  
    }  
    else  
    {  
        $output .= '  
                <tr>  
                     <td colspan="5">No Sold Item Found</td>  
                </tr>  
           ';  
    }  
    $output .= '</table>';  
    echo $output;  
}  
?>