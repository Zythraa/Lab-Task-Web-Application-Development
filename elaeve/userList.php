<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="backgroundPart">
        <h2>List of Employee</h2>

    <?php

    include("header1.php");

    $q = "SELECT userID, userPassword, userName, userPhoneNo, userEmail, userAddress, userPosition, userTotalLeave FROM user ORDER BY userID";

    $result = @mysqli_query ($connect, $q);

    if($result){
        echo '<table border="1">
        <tr class="row1">
            <td align="center" class="idPart"><strong>ID</strong></td>
            <td align="center"><strong>NAME</strong></td>
            <td align="center"><strong>PHONE NO.</strong></td>
            <td align="center"><strong>EMAIL</strong></td>
            <td align="center"><strong>ADDRESS</strong></td>
            <td align="center"><strong>POSITION</strong></td>
            <td align="center"><strong>TOTAL LEAVE</strong></td>
            <td align="center"><strong>UPDATE</strong></td>
            <td align="center"><strong>DELETE</strong></td>
        </tr>';

        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo '<tr class="row2">
            <td>'.$row['userID'].'</td>
            <td>'.$row['userName'].'</td>
            <td>'.$row['userPhoneNo'].'</td>
            <td>'.$row['userEmail'].'</td>
            <td>'.$row['userAddress'].'</td>
            <td>'.$row['userPosition'].'</td>
            <td>'.$row['userTotalLeave'].'</td>
            <td align="center"><a href="userUpdate.php?id='.$row['userID'].'">UPDATE</a></td>
            <td align="center"><a href="userDelete.php?id='.$row['userID'].'">DELETE</a></td>
            </tr>';
        }

        echo '</table>';

        mysqli_free_result($result);

    }else{
        echo '<p class="error">The current user could not be retrieved. We apologize for any inconvenience.</p>';

        echo '<p>'.mysqli_error($connect).'<br><br/>Query:'.$q.'</p>';

    }

    mysqli_close($connect);

    ?>

    </div>
</body>
</html>
