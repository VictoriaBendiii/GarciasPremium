<?php  
//filter.php  
if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
    $connect = mysqli_connect("localhost", "root", "", "garciaspremiumcoffee");  
    $output = '';  
    $query = " SELECT products.productname as oname, branch.branchid, branch.branch_name as boname, orders.quantity as oqty, supplier.supplier_name as soname , delivery.deliveryid, accounts.firstname as aoname, orders.time as t
from (((((orders inner join products on orders.productid = products.productid) 
left join branch on orders.branchid = branch.branchid) 
left join supplier on orders.supplierid = supplier.supplierid)
left join delivery on orders.deliveryid = delivery.deliveryid)
left join accounts on orders.accountid = accounts.accountid) 
where branch.branchid = 1 and orders.time BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' ";  
    $result = mysqli_query($connect, $query);  
    $output .= '  
           <table class="table table-bordered">  
                <tr>  

                               <th width="20%">Branch</th>  
                               <th width="23%">Account Name</th>  
                               <th width="10%">Product Name</th>  
                               <th width="12%">Supplier</th>
                               <th width="10%">Quantity</th>
                               <th width="20%">Time Ordered</th> 
                </tr>  
      ';  
    if(mysqli_num_rows($result) > 0)  
    {  
        while($row = mysqli_fetch_array($result))  
        {  
            $output .= '  
                     <tr>  
                          <td>'. $row["boname"] .'</td>  
                          <td>'. $row["aoname"] .'</td>  
                          <td>'. $row["oname"] .'</td>  
                          <td>'. $row["soname"] .'</td>  
                          <td>'. $row["oqty"] .'</td>  
                          <td>'. $row["t"] .'</td>
                     </tr>  
                ';  
        }  
    }  
    else  
    {  
        $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
    }  
    $output .= '</table>';  
    echo $output;  
}  
?>
