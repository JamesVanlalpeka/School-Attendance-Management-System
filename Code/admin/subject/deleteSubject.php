<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <title>Delete Subject</title>

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
    <a class="dropdown-item" id="navbarDropdown" role="button" href="addSubject.html" >Add Subject</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="deleteSubject.php" >Delete Subject</a>
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

<a class="nav-link text-light font-weight-bold px-3 " href="../attendance/displayattendance.php" id="navbarDropdown" role="button" >Attendence</a>

<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../../logout.php">Logout</a>

</li>

</ul>
</nav>

<!--Navbar end here-->

<div class="center">
    <h1>Delete Subject</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['status'])) {
        ?>
            <?php echo $_SESSION['status']; ?>            
            <?php
                unset($_SESSION['status']);
            }
            ?>

        <form action="deleteSubjectCode.php" method="post">

            <table>
            <tbody>

                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th><button type="submit" name="stud_delete_multiple_btn">Delete</button></th>
                </tr>

            </tbody>

            <tbody>
        
                <?php
                    include('../../db.php');
                    session_start();

                    $query = "SELECT * FROM Subject WHERE status = 1";
                    $query_run = mysqli_query($con,$query);
                    
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        foreach($query_run as $row){
                ?>
                        <tr>
                            <td>    <?= $row['SubjectCode']; ?>     </td>
                            <td>    <?= $row['SubjectName']; ?>     </td>
                            <td>    <input type="checkbox" name="stud_delete_id[]" value="<?= $row['SubjectCode']; ?>">     </td>
                        </tr>

                <?php

                        } 
                    }
                    else {
                ?>
                            <tr>
                                <td>No Record Found</td>
                            </tr>
                        <?php

                    }
                        mysqli_close($con);
                        ?>
            </tbody>
            </table>
        </form>
</div>
</body>
</html>
