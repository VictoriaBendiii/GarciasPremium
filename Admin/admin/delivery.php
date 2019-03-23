<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Manila');

if(isset($_POST['add_delivery'])){
  $time = time();
  $formattedTime = date('y/m/d, H:i:s');

  $sessionUser = getUser();
  $sql1 = "SELECT accountid FROM accounts WHERE username = '$sessionUser' LIMIT 1";
  $result = mysqli_query($sql1);
  $accountid = mysqli_fetch_field($result);

  $prodname = mysqli_real_escape_string($conn, $_POST['product']);
  $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);



} else {
  echo "failed";

}

function getUser(){
  include '../includes/login.inc.php';
  return $uname;


}



 ?>
