<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Manila');

if(isset($_POST['add_delivery'])){
  $time = time();
  $formattedTime = date('y/m/d, H:i:s');
  $supplier = mysqli_real_escape_string($conn, $_POST['supplier']);
  $sessionUser = getUser();

  $prodname = mysqli_real_escape_string($conn, $_POST['product']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

  $sql1 = "SELECT accountid FROM accounts WHERE username = '$sessionUser' LIMIT 1";//gets the id of the current user logged in.
  $result = mysqli_query($sql1);
  $accountid = mysqli_fetch_field($result); //id of user logged in
  $sql2 = "SELECT supplierid FROM garciaspremiumcoffee.supplier WHERE supplier_name = '$supplier'"; // gets the id of the supplier
  $result2 = mysqli_query($sql2);
  $supplierid = mysqli_fetch_field($result2);

  $insertsql = "INSERT INTO `garciaspremiumcoffee`.`orders` (``)"; // START HERE!!!!!!!!!!!!!!!!!!!!!!!



} else {
  header("Location: ../delivery.php?submit=error");
}

function getUser(){
  include '../includes/login.inc.php';
  return $uname;


}



 ?>
