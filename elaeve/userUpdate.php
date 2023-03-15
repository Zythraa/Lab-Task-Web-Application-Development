<html>
<head>
	<title>eLeave Management System</title>
</head>
<body>
	<?php
	//call file to connect server eleave
	include ("header1.php");
	?>
	
	<h2> Edit Employee Record </h2>
	
	<?php
	//look for a valid user id, either through GET or POST
	if ((isset ($_GET['id'])) && (is_numeric($_GET['id'])))
	{
		$id = $_GET['id'];
	}
	else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
	{
		$id = $_POST['id'];
	}
	else
	{
		echo '<p class ="error">This page has been accessed in error.</p>';
		exit();
	}
	
	 if($_SERVER['REQUEST_METHOD']== 'POST'){
        $error = array();// initialize an error array
		
	//check for a userName
	if (empty ($_POST ['userName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string ($connect, trim ($_POST ['userName']));
	}
	
	//check for a userPhoneNo
	if (empty ($_POST ['userPhoneNo']))
	{
		$error [] = 'You forgot to enter your phone number.';
	}
	else
	{
		$ph = mysqli_real_escape_string ($connect, trim ($_POST['userPhoneNo']));
	}
	
	//check for a userEmail
	if (empty ($_POST ['userEmail']))
	{
		$error [] = 'You forgot to enter your email.';
	}
	else
	{
		$e = mysqli_real_escape_string ($connect, trim ($_POST ['userEmail']));
	}
	
	//check for a userAddress
	if (empty ($_POST ['userAddress']))
	{
		$error [] = 'You forgot to enter your address.';
	}
	else
	{
		$ad = mysqli_real_escape_string ($connect, trim ($_POST ['userAddress']));
	}
	
	//check for a userPosition
	if (empty ($_POST ['userPosition']))
	{
		$error [] = 'You forgot to enter your Position.';
	}
	else
	{
		$pos = mysqli_real_escape_string ($connect, trim ($_POST ['userPosition']));
	}
	
	//check for a userPosition
	if (empty ($_POST ['userTotalLeave']))
	{
		$error [] = 'You forgot to enter your total leave.';
	}
	else
	{
		$tl = mysqli_real_escape_string ($connect, trim ($_POST ['userTotalLeave']));
	}
	
	//if no problem occured
	if (empty($error))
	{
		$q = "SELECT userID FROM user WHERE userName= '$n' AND userID != $id";
		
		$result = @mysqli_query ($connect, $q);// run the query
	
	if (mysqli_num_rows($result) == 0)
	{
		$q ="UPDATE user SET userName='$n', userPhoneNo='$ph', userEmail='$e',
		userAddress='$ad', userPosition='$pos', userTotalLeave='$tl'
		WHERE userID ='$id' LIMIT 1";
		
		$result = @mysqli_query ($connect, $q);// run the query
		
		if(mysqli_affected_rows($connect)==1)
		{
			echo '<script>alert("The user has been edited");
            window.location.href="userList.php";</script>';
        }
        else
		{
			echo '<p class="error"> The user has not been edited due 
			to the system error. we apologize for any inconvenience.</p>';
            echo '<p>'.mysqli_error($connect).'<br/> query:'.$q.'</p>';
        }
	}
	else
	{
		echo '<p class ="error">The id had been registered <p/>';
	}
		}
		else 
		{
			echo '<p class ="error">The following error (s) occured: <br/>';
			foreach ($error as $msg)
			{
				echo "-msg<br>\n";
			}
			echo '<p><p>Please try again.<p>';
		}
	}
	
	$q = "SELECT userName, userPhoneNo, userEmail,
	userAddress, userPosition, userTotalLeave
		FROM user WHERE userID = $id";
		
	$result = @mysqli_query ($connect, $q);// run the query
	
	if (mysqli_num_rows($result) ==1)
	{
		//get admin information
		$row =mysqli_fetch_array($result, MYSQLI_NUM);
		
		//create the form
		echo '<form action="userUpdate.php" method ="post">
		<p><label class ="label" for="userName">Employee Name*:</label>
		<input type="text" id="userName" name="userName" size ="30" maxlength="50"
		value="'.$row[0].'"></p>
		
		<p><br><label class ="label" for="userPhoneNo">Phone No.*:</label>
		<input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="userPhoneNo"
		name="userPhoneNo" size="15" maxlength="20" value="'.$row[1].'"></p>
		
		<p><br><label class ="label" for="userEmail">Employee Email*:</label>
		<input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]{2,}$"
		id="userEmail" name="userEmail" size="30" maxlength="50" required
		value="'.$row[2].'"></p>
		
		<p><br><label class ="label" for="userAddress">Employee Address:</label>
		<input type="text" id="userAddress" name="userAddress" size="30"
		maxlength="50" value="'.$row[3].'"></textarea></p>
		
		<p><br><label class="label" for="userPosition">User Position:</label>
		<select name="userPosition" id="userPosition">
		<option value="permanent">Permanent</option>
		<option value="contract">Contract</option>
		<option value="temporary">Temporary</option>
		</select></p>
		
		<p><br><label class ="label" for="userTotalLeave">Total Leave:</label>
		<input type="text" id="userTotalLeave" name="userTotalLeave" size ="30"
		maxlength="50" value="'.$row[5].'"></p>
		
		<br><p><input id ="submit" type="submit" name="submit" value="Update"></p>
		<br><input type="hidden" name="id" value="'.$id.'"/>
		
	</a>
	</form>';
	}
	else
	{ //if it didn't run
		//message
		echo '<p class ="error">This page has been acessed in error<p>';
	} //end of it (result)
	mysqli_close($connect); //close the database connection_aborted
	?>
</body>
</html>
