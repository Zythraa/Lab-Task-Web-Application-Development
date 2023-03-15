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
	
	//validate the adminID
	if (!empty($_POST['adminID']))
	{
		$id = mysqli_real_escape_string ($connect, $_POST['adminID']);
	}
	else
	{
		$id = FALSE;
		echo '<p class="error"> You forgot to enter your ID.</p>';
	}
	
	//validate the admin Password
	if (!empty($_POST['adminPassword']))
	{
		$p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
	}
	else
	{
		$P = FALSE;
		echo '<p class = "error"> You forgot to enter your password.</p>';
	}
	
	//if no problems
	if ($id && $p)
	{
		//Retrieve the adminID, adminPassword, adminName, adminPhoneNo, adminEmail
		$q = "SELECT adminID, adminPassword, adminName, adminPhoneNo, adminEmail
		FROM admin WHERE (adminID = '$id' AND
		adminPassword = '$p')";
		
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
			echo '<p class ="error"> The adminID and adminPassword entered do not match our records
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
	<h2 align ="center"> ADMIN LOGIN</h2>
	
	<form action="adminLogin.php" method="post">
	<div>
		<label for="adminID">Admin ID:</label>
		<input type="text" id="adminID" name="adminID" size="4" maxlength="6"
		value="<?php if (isset($_POST['adminID'])) echo $_POST ['adminID'];?>">
	</div>
	
	<div>
		<label for="adminPassword">Password:</label>
		<input type="password" id="adminPassword" name="adminPassword" size="15" maxLength="60"
		pattern="(?=.\d)(?=.[A-Z]00.(8,)"title="Must contain at least one number and one
		uppercase and lowercase letter, and at least 8 or more characters"required
		value="<?php if (isset($_POST['adminPassword'])) echo $_POST ['adminPassword'];?>">
	</div>
	
	<div>
		<button type="submit">Login</button>
		<button type="reset">Reset</button>
	</div>
	<div>
		<label>Don't have an account?
		<a href="adminRegister.php">Sign Up</a>
		</label>
	</div>
</form>
</body>
</html>
