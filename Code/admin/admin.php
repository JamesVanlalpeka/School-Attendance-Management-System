<?php
	include('../auth.php');
	include('../db.php');
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Subject</title>

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
        /* margin-left: 5px;
        padding-left: 5px;
        padding-right: 20px; */
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

</head>
<body>
    <?php
    $user = $_SESSION['username'];
    ?>

<section = class ="header">
                <h3 style="color: white; text-align: center; padding-top: 3%">Student Attendance Management System</h3>
</section>

<!--Navbar start here-->

<nav class="navbar navbar-expand-md navbar-light bg-dark ">

<button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse justify-content-center" id="nav">

 
<ul class="navbar-nav"><!--Home button-->

	<li class="nav-item" >

	<a class="nav-link text-light font-weight-bold px-3" href="admin.php"><i class="fas fa-home"></i>HOME</a>

	</li>

<!--Teacher-->
<li class="nav-item dropdown">
    <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
    Teacher</a>
    
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" id="navbarDropdown" role="button" href="teacher/addTeacher.html" >Add Teacher</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" id="navbarDropdown" role="button" href="teacher/deleteTeacher.php" >Delete Teacher</a>
    </div>
  </li>

<!--Subject-->
  
<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Subject</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="subject/addSubject.html" >Add Subject</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="subject/deleteSubject.php" >Delete Subject</a>
  </div>
</li>
    
<!--Class-->

<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Class</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="class/addclass.php" >Add Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="class/displayclass.php" >Display Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="class/deleteclass.php" >Delete Class</a>

  </div>
</li>

<!--Student-->

<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Student</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="student/addStudent.php" >Add Student</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="student/deletestudent.php" >Delete Student</a>
  </div>
</li>

<!--Attendance-->

<a class="nav-link text-light font-weight-bold px-3 " href="attendance/displayattendance.php" id="navbarDropdown" role="button" >Attendence</a>

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
                    <input type="reset">       
                    <input type="submit" name="submit">

                </form>
        </div>

        </div>


</li>

<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../logout.php">Logout</a>

</li>

</ul>
</nav>

<!--Navbar end here-->


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