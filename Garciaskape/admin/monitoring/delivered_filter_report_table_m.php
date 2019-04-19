<?php  
include '../includes/connection.php';

if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
     
    $output = '';  
    $query = " SELECT products.productname as name, branch.branchid, branch.branch_name as bname, orders.quantity as qty, supplier.supplier_name as supp, delivery.deliveryid, accounts.firstname as fname, orders.time as t, delivery.status
from (((((orders inner join products on orders.productid = products.productid) 
left join branch on orders.branchid = branch.branchid) 
left join supplier on orders.supplierid = supplier.supplierid)
left join delivery on orders.deliveryid = delivery.deliveryid)
left join accounts on orders.accountid = accounts.accountid) 
where branch.branchid = 1 and delivery.branchid = 1 and orders.time BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ";  

    $result = mysqli_query($conn, $query);  
    $output .= '  
           <table class="table table-bordered">  
                <tr>  

                               <th width="10%">Branch</th>  
                                    <th width="10%">Account Name</th>  
                                    <th width="20%">Product Name</th>  
                                    <th width="20%">Supplier</th>
                                    <th width="10%">Quantity (in kg)</th>
                                    <th width="20%">Time Ordered</th> 
                                    <th width="10%">Status</th>
                </tr>  
      ';  
    if(mysqli_num_rows($result) > 0)  
    {  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                     <tr>  
                          <td>'. $row["bname"] .'</td>  
                          <td>'. $row["fname"] .'</td>  
                          <td>'. $row["name"] .'</td>  
                          <td>'. $row["supp"] .'</td>  
                          <td>'. $row["qty"] .'</td>  
                          <td>'. $row["t"] .'</td>
                          <td>'. $row["status"] .'</td>
                     </tr>  
                ';  
        }  
    }  
    else  
    {  
        $output .= '  
                <tr>  
                     <td colspan="5">No Delivery Found</td>  
                </tr>  
           ';  
    }  
    $output .= '</table>';  
    echo $output;  
}  
?>
