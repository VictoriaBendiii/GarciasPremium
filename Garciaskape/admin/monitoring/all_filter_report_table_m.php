<?php  
include '../includes/connection.php';

if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
    
    $output = '';  
    $query = " SELECT products.productname as name, branch.branchid, branch.branch_name as bname, supplier.supplier_name as sname, accounts.firstname as fname, stock.quantity as stock, orders.quantity as qty, solditem.quantity as sold, orders.time as t
from((((((orders left join products on orders.productid = products.productid)
left join branch on orders.branchid = branch.branchid)
left join supplier on orders.supplierid = supplier.supplierid)
left join accounts on orders.accountid = accounts.accountid)
left join stock on orders.stockid = stock.stockid)
left join solditem on orders.solditemid = solditem.solditemid) 
where branch.branchid =1 and orders.time BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ";  

    $result = mysqli_query($conn, $query);  
    $output .= '  
           <table class="table table-bordered">  
                <tr>  
                                <th width="10%">Branch</th>  
                               <th width="20%">Account Name</th>  
                               <th width="20%">Product Name</th>  
                               <th width="10%">Supplier</th>  
                               <th width="10%">Quantity (Stock in kg)</th>
                               <th width="10%">Quantity (Sold in kg)</th>
                               <th width="20%">Time Sold</th>  
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
                          <td>'. $row["sname"] .'</td>  
                          <td>'. $row["stock"] .'</td>  
                          <td>'. $row["sold"] .'</td>
                          <td>'. $row["t"] .'</td>
                     </tr>  
                ';  
        }  
    }  
    else  
    {  
        $output .= '  
                <tr>  
                     <td colspan="5">No data Found</td>  
                </tr>  
           ';  
    }  
    $output .= '</table>';  
    echo $output;  
}  
?>
