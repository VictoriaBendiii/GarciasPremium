<?php
session_start();


if (isset($_POST['button'])){
    include 'dbh.inc.php';

    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);
    $stripedpwd = strip_tags(mysqli_real_escape_string($conn, trim($pword)));

    if (empty($uname) || empty($pword)) { //
      header("Location: ../index.php?login=empty"); // error
      $_SESSION['errMsg'] = 'Empty Credentials.';
      exit();
    }else {
      $sql = "SELECT * FROM accounts WHERE username ='$uname'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck < 1){
        header("Location: ../index.php?login=error1"); // error
        $_SESSION['errMsg'] = 'User does not exist.';
        exit();
      } else {
        if($row = mysqli_fetch_assoc($result)){
          //VERIFY ACCOUNT HERE
          $hashedPwdCheck = null;
          $realPwd = $row['password'];
          echo '$realPwd';
          if(base64_decode($realPwd) == $stripedpwd){
            $hashedPwdCheck = true;

            if ($hashedPwdCheck == true) {
              //LOGIN USER
              // Session Variables, If needed, try this statement
              // <p><?php echo("{$_SESSION['test']}"."<br />"); *questionMark* *greaterThan*

              $_SESSION['u_name'] = $row['username'];
              $_SESSION['u_type'] = $row['user_type'];
              $_SESSION['status'] = $row['status'];
              $_SESSION['account_id'] = $row['accountid'];
              $_SESSION['branch_id'] = $row['branchid'];
              $_SESSION['firstname'] = $row['firstname'];
              $_SESSION['lastname'] = $row['lastname'];
              $_SESSION['login_user'] = $uname;
              /*
              This part:
              1. checks if the user logging in has an inactive or active account.
              2. checks if the user logging in is an admin or a subadmin.
              */
              if ($_SESSION['status'] == "Active" ){
                if ($_SESSION['u_type'] == "admin"){
                  header("Location: ../admin/index.php");
                }elseif ($_SESSION['u_type'] == "sub-admin1") {
                  header("Location: ../subadmin1/index.php");
                }elseif ($_SESSION['u_type'] == "sub-admin2") {
                  header("Location: ../subadmin2/index.php");
                }
              }elseif ($_SESSION['status'] == "Deactivated") {
                  echo "<script type='text/javascript'>  alert('Account Deactivated'); </script>" ;

              }
           }else{
             $hashedPwdCheck = false;
           }
          }
          if ($hashedPwdCheck == false){
            header("Location: ../index.php?login=error2"); // error
            $_SESSION['errMsg'] = 'Wrong username or password';
            exit();
          }

        }
      }

    }


}else {
  header("Location: index.php?login=error3");
  $_SESSION['errMsg'] = '';
  exit();
}


 ?>
