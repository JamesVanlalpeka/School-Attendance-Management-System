<?php
	$con = mysqli_connect("localhost","osiris","P@ssword123","attendanceDB");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
