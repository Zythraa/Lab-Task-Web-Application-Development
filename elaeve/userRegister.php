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
	//This query inserts a record in the eLeave table
	//has form been submitted?
	if ($_SERVER ['REQUEST_METHOD']== 'POST')
	{
		$error = array ();//initialize an error array
		
	//check for an userPassword
	if (empty ($_POST ['userPassword']))
	{
		$error [] = 'You forgot to enter the password.';
	}
	else
	{
		$p = mysqli_real_escape_string ($connect, trim ($_POST ['userPassword']));
	}
	
	//check for an userName
	if (empty ($_POST ['userName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string ($connect, trim ($_POST ['userName']));
	}
	
	//check for an userPhoneNo
	if (empty ($_POST ['userPhoneNo']))
	{
		$error [] = 'You forgot to enter your phone number.';
	}
	else
	{
		$ph = mysqli_real_escape_string ($connect, trim ($_POST ['userPhoneNo']));
	}
	
	//check for an userEmail
	if (empty ($_POST ['userEmail']))
	{
		$error [] = 'You forgot to enter your email.';
	}
	else
	{
		$e = mysqli_real_escape_string ($connect, trim ($_POST ['userEmail']));
	}
	
	//check for an userAddress
	if (empty ($_POST ['userAddress']))
	{
		$error [] = 'You forgot to enter your address.';
	}
	else
	{
		$ad = mysqli_real_escape_string ($connect, trim ($_POST ['userAddress']));
	}
	
	//check for an userPosition
	if (empty ($_POST ['userPosition']))
	{
		$error [] = 'You forgot to enter your position.';
	}
	else
	{
		$pos = mysqli_real_escape_string ($connect, trim ($_POST ['userPosition']));
	}
	
	//register the user in the database
	//make the query
	$q = "INSERT INTO user (userID, userPassword, userName, userPhoneNo, userEmail,
		userAddress, userPosition, userTotalLeave)
		VALUES ('', '$p', '$n', '$ph', '$e', '$ad', '$pos', '')";
	$result = @mysqli_query ($connect, $q);//run the query
	if ($result)//if it runs
	{
		echo '<h1>thank you</h1>';
		exit();
	}
	else
	{//if it didn't run
		//message
		echo '<h1>System error<h1>';
		
		//debugging message
		echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
	} //end of it (result)
	mysqli_close($connect); //close the database connection_aborted
	exit();
	} //end of the main submit conditional
	?>
	
	<h2>Register User</h2>
	<h4>*required field</h4>
	<form action="userRegister.php" method="post">
	<div>
		<label for="userPassword">Password:</label>
		<input type="password" id="userPassword" name="userPassword" size="15" maxLength="60"
		pattern="(?=.\d)(?=.[a-z])(?=.*[A-Z]00.(8,)"title="Must contain at least one number and one
		uppercase and lowercase letter, and at least 8 or more characters"required
		value="<?php if (isset($_POST['userPassword'])) echo $_POST ['userPassword'];?>">
	</div>
	
	<div>
		<label for="userName">Full Name:</label>
		<input type="text" id="userName" name="userName" size="30" maxLength="50" required
		value="<?php if (isset($_POST['userName'])) echo $_POST ['userName'];?>">
	</div>
	
	<div>
		<label for="userPhoneNo">Phone No.*:</label>
		<input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="userPhoneNo" name="userPhoneNo"
		size="15" maxLength="20" required
		value="<?php if (isset($_POST['userPhoneNo'])) echo $_POST ['userPhoneNo'];?>">
	</div>
	
	<div>
		<label for="userEmail">User Email*:</label>
		<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
		id="userEmail" name="userEmail" size ="30" maxlength="50" required
		value="<?php if (isset($_POST['adminEmail'])) echo $_POST ['userEmail'];?>">
	</div>
	
	<div>
		<label for="userAddress">User Address*:</label>
		<textarea id="userAddress" name="userAddress" size ="30" maxlength="50" required
		value="<?php if (isset($_POST['adminEmail'])) echo $_POST ['userAddress'];?>"></textarea>
	</div>
	
	<div>
		<label for="userPosition">User Position*:</label>
		<select name="userPosition" id="userPosition">
		<option value="permanent">Permanent</option>
		<option value="contract">Contract</option>
		<option value="temporary">Temporary</option>
		</select>
	</div>
	
	<div>
		<button type="submit">Register</button>
		<button type="reset"> Clear All</button>
	</div>
	</form>
</body>
</html>
