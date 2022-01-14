<?php
			include("../auth.php"); //include auth.php file on all secure pages
			require('../db.php');
			
			$user = $_SESSION['username'];
?>

<DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<style>
		a{
			color: black;
			text-decoration: none;

		}
		button{
			background-color: none;

		} 
		/* The Modal (background) */
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
	
			background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
			}

			/* Modal Content/Box */
			.modal-content {
			background-color:whitesmoke;
			margin: 15% auto; /* 15% from the top and centered */
			padding: 20px;
			border: 1px solid #888;
			width: 50%; /* Could be more or less, depending on screen size */
			}

			/* The Close Button */
			.close {

			position: absolute;
			top: 10%;
			right: 35px;
			color:red;
			font-size: 30px;
			font-weight: bold;
			}

			.close:hover,
			.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
			}
</style>

<head>
<body>
<section class ="header">
    <h3 style="color: white; text-align: center; padding-top: 3%">Student Attendance Management System</h3>
</section>

<!--Navbar start here-->

<nav class="navbar navbar-expand-md navbar-light bg-dark ">

<button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse justify-content-center" id="nav">

 
<ul class="navbar-nav"><!--Home button-->

<!-- Change password -->

<li class="nav-item">
       <!-- Trigger/Open The Modal Password -->

        <button id="myBtn" style="background-color:transparent; border:none; " class="nav-link text-light font-weight-bold px-3 ">Change Password</button>

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>

                <form action="../changepassword.php" method="POST">
        <?php

                    echo "<input type='hidden' name='loginId' value='$user'>";

        ?>
                    New Password <input type ="password" name="password1"> 
                    </br></br>
                    Confirm Password <input type="text" name="password2">
                    </br></br>
                    <input type="submit" name="submit">
                    <input type="reset">
                </form>
        </div>

        </div>


</li>

<!-- Logout -->

<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../logout.php">Logout</a>

</li>

</ul>
</nav>

<!--Navbar end here-->

<div class="center">
		<?php

			//code to get the last int in the string
			if(preg_match_all('/\d+/', $user, $numbers))
    		$lastnum = end($numbers[0]);
			
			//code the get the last int in the string
			$filteredNumbers = array_filter(preg_split("/\D+/", $user));
			$firstnum = reset($filteredNumbers);	//to get the student ID
			//code to get the class name
			$className = "Class-".$lastnum;


			$a = mysqli_query($con,"SELECT DISTINCT subjectName FROM Attendance where studentId='$firstnum' and className = '$className'");
			$arr = array();
			
			while($data = mysqli_fetch_array($a))
			{
				$arr[]=$data['subjectName'];
			}
			
			$name = mysqli_query($con,"SELECT studentName FROM Student where studentId='$firstnum' and className = '$className';");
			while($p = mysqli_fetch_array($name))
			{
			
          		echo "Name {$p['studentName']}<br>";
        	}

			echo "Roll no: " . $firstnum;
			echo "</br>";
			echo $className;
			echo "</br></br>";
		?>
			<table>
				<th>SUBJECT</th>
				<th>TOTAL CLASS</th>
				<th>PRESENT CLASS</th>
				<th>PERCENTAGE</th>
		<?php
			for($i=0; $i<count($arr); $i++)
			{
				$a = mysqli_query($con,"SELECT * FROM Attendance where studentId='$firstnum' and className = '$className' AND subjectName='$arr[$i]' AND attendance='Present';");
				$b = mysqli_query($con,"SELECT * FROM Attendance where studentId='$firstnum' and className = '$className' AND subjectName='$arr[$i]';");
				
				$total_present=0;

				foreach($a as $row){
					$total_present++;
				}

			//	$total_present = mysqli_num_rows($a);//how many times present for that subject
				

				$total_attendance_taken = mysqli_num_rows($b);//total number of attendance taken for that subject
				$upper_subjectName=ucwords($arr[$i]);

				echo "<tr>
						<td>$upper_subjectName</td>
						<td>$total_attendance_taken</td>
						<td>$total_present</td>
						<td>".round(($total_present*100/$total_attendance_taken),2)."%</td>
					  </tr>";
			}
		?>
			</table>
				
	<br><br>


</div>
	<script>




				// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
		btn.onclick = function() {
		modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
		}


	</script>
</body>
</html>
