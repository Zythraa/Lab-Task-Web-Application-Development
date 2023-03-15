<html>
<head>
	<title>eLeave Management System</title>
</head>
<body>
	<?php
	//call file to connect server eleave
	include ("header1.php");
	?>
	
	<?php
	//This section processes submission from the login form
	//Check if the form has been submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	
	//validate the userID
	if (!empty($_POST['userID']))
	{
		$id = mysqli_real_escape_string ($connect, $_POST['userID']);
	}
	else
	{
		$id = FALSE;
		echo '<p class="error"> You forgot to enter your ID.</p>';
	}
	
	//validate the user password
	if (!empty($_POST['userPassword']))
	{
		$p = mysqli_real_escape_string($connect, $_POST['userPassword']);
	}
	else
	{
		$P = FALSE;
		echo '<p class = "error"> You forgot to enter your password.</p>';
	}
	
	//if no problems
	if ($id && $p)
	{
		//Retrieve the userID, userPassword, userName, userPhoneNo, userEmail,
		//userAddress,userPosition,userTotalLeave
		$q = "SELECT userID, userPassword, userName, userPhoneNo, userEmail,
		userAddress,userPosition,userTotalLeave
		FROM user WHERE (userID = '$id' AND
		userPassword = '$p')";
		
		//run the query and assign it to the variable $result
		$result = mysqli_query ($connect, $q);
		
		//count the number of rows that match the adminID/adminPassword combination
		//if one database row (record) matches the input:
		if (@mysqli_num_rows ($result) ==1)
		{
	
			//start the session, fetch the record and insert the three values in an array
			session_start();
			$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo '<p> Welcome to eLeave System <p>';
			
			//Cancel the rest of the script
			exit();
		
			mysqli_free_result ($result);
			mysqli_close ($connect);
			//no match was made
		}
		else
		{
			echo '<p class ="error"> The userID and userPassword entered do not match our records
			<br> perhaps you need to register, just click the Register button</p>';
		}
	//if there was a problems
	}
	else
	{
		echo '<p class ="error"> Please try again. </p>';
	}
	mysqli_close($connect);
}//end of submit reconditional

	?>
	<h2 align ="center"> USER LOGIN</h2>
	
	<form action="userLogin.php" method="post">
	<div>
		<label for="userID">User ID:</label>
		<input type="text" id="userID" name="userID" size="4" maxlength="6"
		value="<?php if (isset($_POST['userID'])) echo $_POST ['userID'];?>">
	</div>
	
	<div>
		<label for="userPassword">Password:</label>
		<input type="password" id="userPassword" name="userPassword" size="15" maxLength="60"
		pattern="(?=.\d)(?=.[A-Z]00.(8,)"title="Must contain at least one number and one
		uppercase and lowercase letter, and at least 8 or more characters"required
		value="<?php if (isset($_POST['userPassword'])) echo $_POST ['userPassword'];?>">
	</div>
	
	<div>
		<button type="submit">Login</button>
		<button type="reset">Reset</button>
	</div>
	<div>
		<label>Don't have an account?
		<a href="userRegister.php">Sign Up</a>
		</label>
	</div>
</form>
</body>
</html>
