<html>
<head>
	<title>eLeave Management System</title>
</head>
<body>
	<?php
	//call file to connect server eleave
	include ("header1.php");
	?>
	
	<form action="userFound.php" method="post">
	
	<h1>Search employee record</h1>
	<p><label class="label" for="userName">Employee Name:</label>
	<input id="userName" type="text" name="userName" size="30"
	maxlength="50" value="<?php if (isset($_POST['userName']))
	echo $_POST ['userName']; ?>"/></p>

	<input id="submit" type="submit" name="submit" odyearch"/></p>
	</form>
</body>
</html>
