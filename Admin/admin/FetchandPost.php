<!DOCTYPE html>
<?php
    session_start();
    include_once 'connection.php';
?>
<html>
    <head>
        <title>fetchandpost</title>
    </head>
    <?php
        if(isset($_POST['submitform'])) {
            /*require 'sample.php'; this contains the functions*/
            $sql = "INSERT INTO table1 (product) VALUES ('".$_POST['product']."')";
            $conn->query($sql);
        }
    ?>
    <body>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM table1";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['product'].'</td>
                        </tr>';
                        
                    }
                ?>
            </tbody>
        </table>
        <form action="index.php" method="POST">
            <input type="text" name="product">
            
            <button type="submit" name="submitform" >Add</button>
        </form>
    </body>
</html>