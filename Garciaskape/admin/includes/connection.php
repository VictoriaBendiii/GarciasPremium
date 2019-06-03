    
<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "garciaspremiumcoffee";
try{
  $conn = mysqli_connect( $dbservername, $dbusername, $dbpassword, $dbname);
} catch (mysqli_sql_exception $exc){
    die("Can't connect to the database! \n" . $exc); // Error: 
}
?>