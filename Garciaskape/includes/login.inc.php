<?php
session_start();


if (isset($_POST['button'])){
    include 'dbh.inc.php';

    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);

    $stripedpwd = strip_tags(mysqli_real_escape_string($conn, trim($pword)));

    if (empty($uname) || empty($pword)) { //
      header("Location: ../index.php?login=empty"); // error
      exit();
    }else {
      $sql = "SELECT * FROM accounts WHERE username ='$uname'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck < 1){
        header("Location: ../index.php?login=error1"); // error
        exit();
      } else {
        if($row = mysqli_fetch_assoc($result)){
          //VERIFY ACCOUNT HERE
          $hashedPwdCheck = null;
          $hashedPwd = $row['password'];
          if(password_verify($stripedpwd , $hashedPwd)){
            $hashedPwdCheck = true;
            // echo "line 31";
            if ($hashedPwdCheck == true) {
              //LOGIN USER!!
              $_SESSION['u_name'] = $row['username'];     // SESSION VARIABLES IF U GUYS NEED JUST
              $_SESSION['u_type'] = $row['user_type'];    // SESSION VARIABLES IF U GUYS NEED JUST
              $_SESSION['status'] = $row['status'];       // SESSION VARIABLES IF U GUYS NEED JUST
              $_SESSION['account_id'] = $row['accountid'];       // SESSION VARIABLES IF U GUYS NEED JUST
              $_SESSION['branch_id'] = $row['branchid'];
              /*
              This part:
              1. checks if the user loggin  in has an inactive or active account.
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
              }elseif ($_SESSION['status'] == "deactivated") {
                  echo '<script language="javascript">';
                  echo 'alert("Account is deactivated \nPlease Go Back to the Login Page.");';
                  echo '</script>';

              }
           }else{
             $hashedPwdCheck = false;
           }
          }
          if ($hashedPwdCheck == false){
            header("Location: ../index.php?login=error2"); // error
            exit();
          }

        }
      }

    }


}else {
  header("Location: ../index.php?login=error3");
  exit();
}


 ?>
