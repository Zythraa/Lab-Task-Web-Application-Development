<html>
<head>
	<title>eLeave Management System</title>
</head>
<body>
	<?php
	//call file to connect server eleave
	include ("header1.php");
	?>
	
	<form action="adminFound.php" method="post">
	
	<h1>Search admin record</h1>
	<p><label class="label" for="adminName">Admin Name:</label>
	<input id="adminName" type="text" name="adminName" size="30"
	maxlength="50" value="<?php if (isset($_POST['adminName']))
	echo $_POST ['adminName']; ?>"/></p>

	<input id="submit" type="submit" name="submit" value="search"/></p>
	</form>
</body>
</html>
