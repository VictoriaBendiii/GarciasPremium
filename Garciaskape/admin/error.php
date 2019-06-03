<?php
session_start();
?>
<?php
$status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
       403 => array('403 Forbidden', 'The server has refused to fulfill your request. '),
       404 => array('404 Not Found', 'The document/file requested was not found on this server.'),
       405 => array('405 Method Not Allowed', 'The method specified in the Request-Line is not allowed for the specified resource.'),
       408 => array('408 Request Timeout', 'Your browser failed to send a request in the time allowed by the server.'),
       500 => array('500 Internal Server Error', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
       502 => array('502 Bad Gateway', 'The server received an invalid response from the upstream server while trying to fulfill the request.'),
       504 => array('504 Gateway Timeout', 'The upstream server failed to send a request in the time allowed by the server.'),
      );

$title = $codes[$status][0];
$message = $codes[$status][1];
if ($title == false || strlen($status) != 3) {
       $message = 'Please supply a valid status code.';
}

?>



<!------ Include the above in your HEAD tag ---------->

<style>
    .error{
        color: red;
    }

    #remember{
        color: white;
    }
</style>

<!DOCTYPE html>
<html>

    <head>
        <title>Garcias Premium Coffee</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <!--Steven Mangati-->
    <body>
        <div class="container h-100">
          <h2 style="color:red; text-align: center;"> <?php echo $title;?> </h2><br>
          <h3 style="color:red; text-align: center;"> Please go back to the <a href = "../includes/logout.inc.php"> login page</a></h3>
          <br>
          <center><img src="../question.png"></center>
          <center><img src="../error.png"></center>
        </div>
    </div>

</body>
</html>
