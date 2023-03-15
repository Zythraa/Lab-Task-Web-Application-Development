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
		
	//check for an adminPassword
	if (empty ($_POST ['adminPassword']))
	{
		$error [] = 'You forgot to enter the password.';
	}
	else
	{
		$p = mysqli_real_escape_string ($connect, trim ($_POST ['adminPassword']));
	}
	
	//check for an adminName
	if (empty ($_POST ['adminName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string ($connect, trim ($_POST ['adminName']));
	}
	
	//check for an adminPhoneNo
	if (empty ($_POST ['adminPhoneNo']))
	{
		$error [] = 'You forgot to enter your phone number.';
	}
	else
	{
		$ph = mysqli_real_escape_string ($connect, trim ($_POST ['adminPhoneNo']));
	}
	
	//check for an adminEmail
	if (empty ($_POST ['adminEmail']))
	{
		$error [] = 'You forgot to enter your email.';
	}
	else
	{
		$e = mysqli_real_escape_string ($connect, trim ($_POST ['adminEmail']));
	}
	
	//register the admin in the database
	//make the query
	$q = "INSERT INTO admin (adminID, adminPassword, adminName, adminPhoneNo, adminEmail)
		VALUES ('', '$p', '$n', '$ph', '$e')";
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
	
	<h2>Register Admin</h2>
	<h4>*required field</h4>
	<form action="adminRegister.php" method="post">
	<div>
		<label for="adminPassword">Password:</label>
		<input type="password" id="adminPassword" name="adminPassword" size="15" maxLength="60"
		pattern="(?=.\d)(?=.[A-Z]00.(8,)"title="Must contain at least one number and one
		uppercase and lowercase letter, and at least 8 or more characters"required
		value="<?php if (isset($_POST['adminPassword'])) echo $_POST ['adminPassword'];?>">
	</div>
	
	<div>
		<label for="adminName">Admin Name:</label>
		<input type="text" id="adminName" name="adminName" size="30" maxLength="50" required
		value="<?php if (isset($_POST['adminName'])) echo $_POST ['adminName'];?>">
	</div>
	
	<div>
		<label for="adminPhoneNo">Phone No.*:</label>
		<input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="adminPhoneNo" name="adminPhoneNo"
		size="15" maxLength="20" required
		value="<?php if (isset($_POST['adminPhoneNo'])) echo $_POST ['adminPhoneNo'];?>">
	</div>
	
	<div>
		<label for="adminEmail">Admin Email*:</label>
		<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
		id="adminEmail" name="adminEmail" size ="30" maxlength="50" required
		value="<?php if (isset($_POST['adminEmail'])) echo $_POST ['adminEmail'];?>">
	</div>
	
	<div>
		<button type="submit">Register</button>
		<button type="reset"> Clear All</button>
	</div>
	</form>
</body>
</html>
