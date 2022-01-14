<?php
	require('db.php');
	session_start();
	
	function authentication($type_of_user, $userId, $username, $password,$con)
	{
		$username = strtolower($username);
		$query = "SELECT * FROM Login WHERE loginId='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query);// or die(mysql_error());
		$rows = mysqli_num_rows($result);
		
		if($rows==1)
		{
			$flag = mysqli_query($con,"SELECT flag FROM Login WHERE loginId='$username';");
			$data = mysqli_fetch_assoc($flag);
			if($data['flag'] == 1 && $type_of_user=="admin")
			{
				$_SESSION['username'] = $username;
				header("Location: admin/admin.php"); // Redirect user to admin/admin.html
			}
			
			else if($data['flag'] == 2 && $type_of_user=="teacher")
			{
				$_SESSION['username'] = $username;
				header("Location: teacher/teacher.php"); // Redirect user to teacher/teacher.php
			}
			
			else if($data['flag'] == 3 && $type_of_user=="student")
			{
				$_SESSION['username'] = $username;
				header("Location: student/student.php"); // Redirect user to student/student.php
			}
		
			else
				echo "<h3>Username/password is incorrect.</h3><br/>Click here to <a href='index.html'>Login</a></div>";
		}
		
		else
			echo "<h3>Username/password is incorrect.</h3><br/>Click here to <a href='index.html'>Login</a></div>";
	}
	
	
	if(isset($_POST['username'])){
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
	
		//authentication
		if(($_POST['submit'])=="admin login")
			authentication("admin","adminId",$username,$password,$con);
			
		elseif(($_POST['submit'])=="teacher login")
			authentication("teacher","teacherId",$username,$password,$con);
			
		elseif(($_POST['submit'])=="student login")
			authentication("student","studentId",$username,$password,$con);
		
		else
			echo "<h3>Username/password is incorrect.</h3><br/>Click here to <a href='index.html'>Login</a>";
	}
	
	else
		echo "<h3>Username/password is incorrect.</h3><br/>Click here to <a href='index.html'>Login</a>";
?>


