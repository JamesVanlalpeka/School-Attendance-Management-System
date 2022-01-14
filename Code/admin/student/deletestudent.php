<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>

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
    <a class="dropdown-item" id="navbarDropdown" role="button" href="addStudent.php" >Add Student</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" id="navbarDropdown" role="button" href="deletestudent.php" >Delete Student</a>
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
    <h1>Delete Student</h1>
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
    
                echo "<br>";
                echo "<input type='reset'>";
                echo "<input type='submit' name='submit'>";



                echo "</form>";
            ?>


            <?php

                if(isset($_POST["class_name_id"])) {

                    $class_name = $_POST['class_name_id'];

                    echo"<br>";

                    echo "<p>" . $class_name . "</p>";  //display classname
            ?>


                    <!-- <form action="" method="POST">
                        Search User-->
                        <!-- <input type="text" name="search" id="text" placeholder="Search User by ID"> 
                        <input type="submit" value="search">
            
                    </form> -->

                    <!-- <form action="deletestudentcode.php" method="POST">  -->
            <?php
                        // if(isset($_POST["search"])) {
                        //     $search_key = $_POST['search'];
                        //     echo $search_key;

                                // $query = "SELECT * FROM Student WHERE studentId = '$search_key' AND className = '$class_name' status = 1";
                                // $query_run = mysqli_query($con, $query);

                                // foreach($query_run as $value){
            ?>
                                    <!-- <table>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Select</th>
                                        </tr>
                                        <tr>
                                    
                                            <td>    <?//= $value['studentId']; ?>     </td>
                                            <td>    <?//= $value['studentName']; ?>     </td>
                                            <td>    <input type="checkbox" name="stud_delete_id[]" value="<?= $value['studentId']; ?>">   </td>
                                        </tr>

                                    </table> -->
            <?php
                                //}
                            

                        // }

            ?>

                    <!-- </form> -->
            <?php

                    echo "<form action='deletestudentcode.php' method='post'>";

                        echo"<input type ='hidden' name ='className' value = '$class_name'>";
            ?>
                        <button type="submit" name="stud_delete_multiple_btn">Delete</button>
                        
                        <table style="border-style:solid; border-color:black";>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Select</th>
                            </tr>
            <?php
                            $query = "SELECT studentId, studentName FROM Student WHERE className='$class_name' AND status = 1"; 
                            $query_run = mysqli_query($con,$query); 
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $row){
            ?>
                    
                            <tr>
                                    
                                    <td>    <?= $row['studentId']; ?>     </td>
                                    <td>    <?= $row['studentName']; ?>     </td>
                                    <td>    <input type="checkbox" name="stud_delete_id[]" value="<?= $row['studentId']; ?>">   </td>
                            </tr>
                
                
                
            <?php      
                                }
                            }

            ?>
                        </table>

                
                    </form>

                
            <?php

                }
    ?> 



    <?php
                    // //code to delete student start here
                    // if(isset($_POST['stud_delete_multiple_btn'])) {

                    //     $all_StudentId = $_POST['stud_delete_id'];
                    //     $class_name = $_POST['className'];
                        
                    //     $extract_StudentId = implode(',' , $all_StudentId);                        
                        
                    //     $query1 = "UPDATE Student SET status = 0 WHERE studentId IN($extract_StudentId)";
                    //     $query_run1 = mysqli_query($con,$query1);
                        
                        
                    //     foreach($all_StudentId as $value){
                        
                    //         $deleteLoginStudentId = $value.$class_name;
                        
                    //         $query2 = "UPDATE Login SET status = 0 WHERE loginId = '$deleteLoginStudentId' ";
                    //         $query_run2 = mysqli_query($con,$query2);
                            
                    //     }
                              
                        
                    //     if($query_run1 and $query_run2) {
                    //         $_SESSION['status'] = "Data Deleted Successfully";
                    //         header("Location: deletestudent.php");
                        
                    //     }
                    //     else{
                    //         $_SESSION['status'] = "Data Not Deleted";
                    //         header("Location: deletestudent.php");
                    //     }
                            
                        
                    //     }   //code to delete student end here

    mysqli_close($con);

    ?>
</div>
</body>
</html>
