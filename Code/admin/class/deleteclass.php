<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Class</title>

<link rel="stylesheet" href="../../css/style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
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

	<a class="nav-link text-light font-weight-bold px-3" href="../admin.php"><i class="fas fa-home"></i>HOME</a>

	</li>

<!--Teacher-->
<li class="nav-item dropdown">
    <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
    Teacher</a>
    
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" id="navbarDropdown" role="button" href="../teacher/addTeacher.html" >Add Teacher</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" id="navbarDropdown" role="button" href="../teacher/deleteTeacher.php" >Delete Teacher</a>
    </div>
  </li>

<!--Subject-->
  
<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Subject</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../subject/addSubject.html" >Add Subject</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../subject/deleteSubject.php" >Delete Subject</a>
  </div>
</li>
    
<!--Class-->

<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Class</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="addclass.php" >Add Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="displayclass.php" >Display Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="deleteclass.php" >Delete Class</a>

  </div>
</li>

<!--Student-->

<li class="nav-item dropdown">
  <a class="nav-link text-light font-weight-bold px-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Student</a>
  
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../student/addStudent.php" >Add Student</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../student/deletestudent.php" >Delete Student</a>
  </div>
</li>

<!--Attendance-->

<a class="nav-link text-light font-weight-bold px-3 " href="../attendance/displayattendance.php" id="navbarDropdown" role="button" >Attendence</a>

<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../../logout.php">Logout</a>

</li>

</ul>
</nav>

<!--Navbar end here-->

<div class="center">
    <h1>Delete Class</h1>
        <br><br>

    <p>Select Class Name</p>             

            <?php
                include('../../db.php');
                session_start();

                echo "<form action='' method='post'>";

                echo "<select name='class_name_id'>";
                echo "<option disabled selected>Class</option>";
            
                    $records = mysqli_query($con, "SELECT DISTINCT (ClassName) from Class WHERE status = 1");
    
                    while($data = mysqli_fetch_array($records)) {
                        echo "<option value=" . $data["ClassName"] . ">" .$data["ClassName"] . "</option>";
                    }	
                                        
                echo "</select>";
    
                echo "<br><br>";
                echo "<input type='reset'>";
                echo "<input type='submit' name='delete__btn'>";



                echo "</form>";
            ?>

            <?php

                if(isset($_POST["delete__btn"])) {
                
                            $class_name = $_POST['class_name_id'];

                            echo "<p>" . $class_name . "</p>";  //display classname

                            $query = "UPDATE Class SET status = 0 WHERE className = '$class_name'";
                            $query_run = mysqli_query($con,$query);

                            if($query_run) {
                                echo $class_name . " Deleted Successfully";
                            }
                            else{
                                echo $class_name . " Not Deleted";
                            }
                }
            mysqli_close($con); 
            ?>
</div>
</body>
</html>

