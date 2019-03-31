<?php
if(isset($_POST['abc'])){
    // Authorisation details.
    $username = "javerocks21@gmail.com";
    $hash = "9f87b637bb0403b953897f20bee12ffe79c16d5d72ed695c75e9ef7be51d61ab";

    // Config variables. Consult http://api.txtlocal.com/docs for more info.
    $test = "0";

    // Data for text message. This is the text message data.
    $sender = $_POST['sender']; // This is who the message appears to be from.
    $numbers = $_POST['num']; // A single number or a comma-seperated list of numbers
    $messageArray = $_POST['beans'];
    $message = implode(" ", $messageArray);
    // 612 chars or less
    // A single number or a comma-seperated list of numbers
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.txtlocal.com/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); // This is the result from the API
    curl_close($ch);
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <script type="text/javascript">
            function cloneRow()
            {
                var row = document.getElementById("dropdowns");
                var table = document.getElementById("table");
                var clone = row.cloneNode(true);
                clone.id = "dropdownsclone";
                table.appendChild(clone);
            }
        </script>
    </head>
    <body>
        <form method="post" action="pushnotif.php">
            <table align="center">
                <tr>
                    <td>sender:</td>
                    <td><input type="text" name="sender" placeholder="enter your name"></td>
                </tr>
                <tr>
                    <td>number:</td>
                    <td><input type="text" name="num" placeholder="enter your number"></td>
                </tr>
            </table>
            <table style="width: 50%" id="table">
                <tr>
                    <th>
                        <h3>FROM</h3>
                    </th>
                    <th>
                        <h3>TO</h3>
                    </th>
                    <th>
                        <h3>COFFEE BEAN</h3>
                    </th>
                    <th>
                        <h3>QTY(kg)</h3>
                    </th>
                </tr>

                <tr id="dropdowns">
                    <th id="from">
                        <select name="from">
                            <option value="sablan">Sablan</option>
                            <option value="atok">Atok</option>
                        </select>
                    </th>
                    <th id="to">
                        <select name="to">
                            <option value="market">Market</option>
                            <option value="porta">Porta Vaga</option>
                        </select>
                    </th>
                    <th id="beans">
                        <select name="beans[]">
                            <option value="premExcelsa">Premium Barako Excelsa</option>
                            <option value="arabmed">Arabica Medium Blend</option>
                            <option value="barako">Barako Blend Coffee</option>
                            <option value="benguet">Benguet</option>
                            <option value="barako">Barako</option>
                            <option value="sagdark">Sagada Dark</option>
                            <option value="sagmed">Sagada Medium</option>
                            <option value="housearab">House Blend Arabica</option>
                            <option value="italesp">Italian Espresso</option>
                            <option value="kalmed">Kalinga Medium</option>
                            <option value="kaldark">Kalinga Dark</option>
                            <option value="hazelnut">Hazelnut</option>
                            <option value="mocha">Mocha</option>
                            <option value="hazelvan">Hazelnut-Vanilla</option>
                            <option value="vanilla">Vanilla</option>
                            <option value="butterscotch">Butterscotch</option>
                            <option value="macadamia">Macadamia</option>
                            <option value="cinnamon">Cinnamon Nut</option>
                            <option value="irish">Irish Cream</option>
                            <option value="caramel">Caramel</option>
                            <option value="cookiescream">Cookies and Cream</option>
                            <option value="baileys">Bailey''s Irish Cream</option>
                            <option value="doublechoco">Double Chocolate</option>

                        </select>
                    </th>
                    <th id="quantity">
                        <input type="text" name="beans[]" placeholder="enter quantity">
                    </th>
                </tr>
                <tr>
                    <td><input type="button" onclick="cloneRow()" value="Clone Row"/></td>
                    <td><input type="submit" name="abc" value="send"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>