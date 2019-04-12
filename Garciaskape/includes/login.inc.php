<?php
session_start();

if (isset($_POST['button'])){
    include 'dbh.inc.php';

    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);


    if (empty($uname) || empty($pword)) {
      header("Location: ../index.php?login=empty");
      exit();
    }else {
      $sql = "SELECT * FROM accounts WHERE username ='$uname'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck < 1){
        header("Location: ../index.php?login=error");
        exit();
      } else {
        if($row = mysqli_fetch_assoc($result)){
          //dehashing
          //VERIFY HERE
          $hashedPwdCheck = null;
          if($pword == $row['password']){
            $hashedPwdCheck = true;
          }else{
            $hashedPwdCheck = false;
          }
          if ($hashedPwdCheck == false){
            header("Location: ../index.php?login=error");
            exit();
          } elseif ($hashedPwdCheck == true) {
            //LOGIN USER!!
            $_SESSION['u_name'] = $row['username'];
            $_SESSION['u_type'] = $row['user_type'];


            if ($_SESSION['u_type'] == "admin"){
            header("Location: ../admin/index.php");
          }elseif ($_SESSION['u_type'] == "sub-admin1") {
            header("Location: ../subadmin1/index.php");
          }elseif ($_SESSION['u_type'] == "sub-admin2") {
            header("Location: ../subadmin2/index.php");
          }
         }

        }
      }

    }


}else {
  header("Location: ../index.php?login=error");
  exit();
}



 ?>
