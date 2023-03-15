<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("header1.php");

    if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
        $id = $_GET['id'];
    }
    else if((isset($_POST['id'])) && (is_numeric($_POST['id']))){
        $id = $_POST['id'];
    }
    else{
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $error = array();

        if(empty ($_POST['adminName'])){
            $error [] = 'You forgot to enter your name.';
        }
        else{
            $n = mysqli_real_escape_string ($connect, trim ($_POST['adminName']));
        }

        if(empty ($_POST['adminPhoneNo'])){
            $error [] = 'You forgot to enter your phone number.';
        }
        else{
            $ph = mysqli_real_escape_string ($connect, trim ($_POST['adminPhoneNo']));
        }

        if(empty ($_POST['adminEmail'])){
            $error [] = 'You forgot to enter your email.';
        }
        else{
            $e = mysqli_real_escape_string ($connect, trim ($_POST['adminEmail']));
        }

        if(empty($error)){
            $q = "SELECT adminID FROM admin WHERE adminName = '$n' AND adminID != $id";

            $result = @mysqli_query ($connect, $q);

            if(mysqli_num_rows($result)==0){
                $q = "UPDATE admin SET adminName = '$n', adminPhoneNo ='$ph', adminEmail ='$e' WHERE adminID ='$id' LIMIT 1";

                $result = @mysqli_query ($connect, $q);

                if(mysqli_affected_rows($connect)==1){
                    echo '<script>alert("The user has been edited");
                    window.location.href="adminList.php";</script>';
                }
                else{
                    echo '<p class="error"> The user has not been edited due to the system error. we apologize for any inconvenience.</p>';
                    echo '<p>'.mysqli_error($connect).'<br/> query:'.$q.'</p>';
                }
            }
            else{
                echo '<p class="error">The id had been registered</p>';
            }
        }
        else{
            echo '<p class="error">The following error (s) occured: <br/>';
            foreach ($error as $msg){
                echo " -msg<br>\n";
            }
            echo '<p><p>Please try again.<p>';
        }
    }

    $q = "SELECT adminName, adminPhoneNo, adminEmail FROM admin WHERE adminID = $id";

    $result = @mysqli_query ($connect, $q);

    if(mysqli_num_rows ($result)==1){
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        echo '<form action="adminUpdate.php" method="post">
        <p><label class="label" for="adminName">Admin Name*:</label>
        <input type="text" name="adminName" id="adminName" size="30" maxlength="50" value="'.$row[0].'"></p>

        <p><br><label for="adminPhoneNo" class="label">Phone No.*:</label>
        <input type="tel" name="adminPhoneNo" id="adminPhoneNo" pattern="[0-9]{3}-[0-9]{7}" size="15" maxlength="20" value="'.$row[1].'"></p>

        <p><br><label for="adminEmail" class="label">Admin Email*:</label>
            <input type="text" name="adminEmail" id="adminEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" size="30" maxlength="50" required value="'.$row[2].'"></p>

            <p><br><input type="submit" name="submit" id="submit" value="Update"></p>
            <br><input type="hidden" name="id" value="'.$id.'"/>

    </form>';
    }
    else{
        echo '<p class="error">This page has been accessed in error</p>';
    }

    mysqli_close($connect);
    ?>
</body>
</html>