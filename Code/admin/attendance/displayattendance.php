<?php
//	include('../../auth.php');
	include('../../db.php');
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
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
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../class/addclass.php" >Add Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../class/displayclass.php" >Display Class</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="../class/deleteclass.php" >Delete Class</a>

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

<a class="nav-link text-light font-weight-bold px-3 " href="displayattendance.php" id="navbarDropdown" role="button" >Attendence</a>

<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../../logout.php">Logout</a>

</li>

</ul>
</nav>

<!--Navbar end here-->

<div class="center">

        <h3>Attendance</h3>

        <p>Select Class Name</p>             

        
        <form action="" method="post">
                <?php
//displaying class list name
                    $query = "SELECT DISTINCT  ClassName FROM Class WHERE status = 1";
                    $query_run = mysqli_query($con,$query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                 
                        echo"<select name = 'class_name_id' required>";
                        	echo"<option value='' selected disabled hidden>Select Class</option>";

                        foreach($query_run as $row)
                        {
                
		                    echo "<option value=" . $row["ClassName"] . ">" .$row["ClassName"] . "</option>";
            
                        }
                        echo"</select>";

                        echo "</br></br>";

                        echo "<input type='date' name='selectDate' required>";//input date
 
                    }     
                    else {

                    	echo "<p>No Record Found</p>";

                    }
                    echo "</br></br>";
                    echo "<input type='reset'>";
                    echo "<input type='submit' name='submit'>";

                ?>
        </form>


        <?php

            echo "<form action='' method='post'>";
                if(isset($_POST["class_name_id"])) {
                    $class_name = $_POST['class_name_id'];
                    $date = $_POST['selectDate'];

                    echo "<input type='hidden' name='class_name' value='$class_name' >";
                    echo "<input type='hidden' name='date' value='$date' >";

                    $query1 = "SELECT DISTINCT subjectName from Attendance where className = '$class_name' and cur_date = '$date'";
                    $query1_run = mysqli_query($con, $query1);

                    echo "</br></br>";

                    if(mysqli_num_rows($query1_run) > 0){
                        
                        echo "<select name = 'subject_name_id' required>";  
                        echo "<option value='' selected disabled hidden>Select Subject</option>";
                        
                        foreach($query1_run as $row) {
                            echo "<option value=" . $row["subjectName"] . ">" .$row["subjectName"] . "</option>";                              
                        }
                        echo "</select>";
                        
                    }
                    else {
                    echo" <p>No Record Found</p>";
                    }

                    echo "</br></br>";
                    echo "<input type='reset'>";
                    echo "<input type='submit' name='submit'>";


                }

            echo "</form>";
        ?>

        <?php

                

            

                if(isset($_POST["subject_name_id"])) {

                    echo"<form action='export.php' method='post'>";
                    $subjectName = $_POST['subject_name_id'];
                    $className = $_POST['class_name'];
                    $date = $_POST['date'];

                    echo $className;
                    echo "<br>";
                    echo $subjectName;
                    echo "<br>";
                    echo $date;
                    echo "<br>";

                    echo "<input type='hidden' name='className' value='$className'>";
                    echo "<input type='hidden' name='subjectName' value='$subjectName'>";
                    echo "<input type='hidden' name='date' value='$date'>";

                    $query2 = "SELECT studentId, attendance FROM Attendance WHERE className = '$className' and subjectName = '$subjectName' and cur_date = '$date'";
                    $query2_run = mysqli_query($con, $query2);

                    echo "<table id='' style='border-style:solid; border-color:black';>";
                            echo"<tr>";
                                echo" <th>Roll no.</th>";
                                echo" <th>Name</th>";
                                echo" <th>Status</th>";
                    echo" </tr>";

                    if(mysqli_num_rows($query2_run) > 0) {
                        foreach($query2_run as $row){
                            $stuId = $row['studentId'];
                            $query4 = "SELECT studentName from Student WHERE className = '$className' and studentId = '$stuId' and status = 1";
                            $query4_run = mysqli_query($con, $query4);


                            foreach($query4_run as $studentName){
    ?>
                                <tr>
                                    <td>    <?= $row['studentId']; ?>     </td>
                                    <td>    <?= $studentName['studentName']; ?>     </td>
                                    <td>    <?= $row['attendance'];?>   </td>
                                </tr>
    <?php
                            }
                    }
                    }
                echo "</table>";
     
                  //      echo"<input type='submit' name='export' value='Export'>";
                    
                
            echo "</form>";
                }


        ?>

</div>
    </body>
</html>