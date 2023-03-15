<html>
<head>
	<title>eLeave Management System</title>
</head>

<?php
	//call file to connect server eleave 
	include ("header1.php");
?>
<h2> Search Result </h2>

<?php
	$in=$_POST['adminName'];
	$in=mysqli_real_escape_string($connect, $in);
	
	//make the query
	$q = "SELECT adminID, adminPassword, adminName,
	adminPhoneNo, adminEmail FROM admin WHERE
	adminName='$in' ORDER BY adminID";
	
	//run the query and assign it to the variable $result
	$result = @mysqli_query ($connect, $q);
	
	if ($result)
	{
		//Table heading
		echo '<table border ="2">
		<tr>
		<td align="center"><strong>ID</strong></td>
		<td align="center"><strong>NAME</strong></td>
		<td align="center"><strong>PHONE NO.</strong></td>
		<td align="center"><strong>EMAIL</strong></td>
		</tr>';
	//Fetch and print all the records
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<tr>
		<td>'.$row['adminID'].'</td>
		<td>'.$row['adminName'].'</td>
		<td>'.$row['adminPhoneNo'].'</td>
		<td>'.$row['adminEmail'].'</td>
		</tr>';
	}
	//close the table
	echo '</table>';
	
	//free up the resources
	mysqli_free_result ($result);
	//if failed to run
	}
	else
	{
		//error message
		echo '<p class ="error"> If no record is shown, this 
		is because you had an incorrect or missing entry in 
		search form.<br>Click the back button on the browser
		and try again.</p>';
		
		//debugging message
		echo '<p>'.mysqli_error ($connect).'<br><br/>Query:'.$q.'</p>';
	} //end of if (result)
		//close the database connection
	mysqli_close($connect);
?>

</div>
</div>
</body>
</html>
