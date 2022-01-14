


<!doctype html>
<html lang="en">
<head>

<meta charset="UTF-8">
    <title>Add Student</title>

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



<body>
    <div class="center">
        
        <div class="container"style="max-width: 700px;">

            <form action="addStudentCode.php" method="post">
                
                <div class="row">
                    <div class="col-lg-12">
                        <div id="inputFormRow">
                            <div class="input-group mb-3">
                                <input type="text" name="title[]" class="form-control m-input" placeholder="Enter Name" required autocomplete="off">
                                <div class="input-group-append">                
                                    <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>

                        <div id="newRow"></div>
                        <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                    </div>
                </div>


                <?php   //selecting class code
                    include('../../db.php');
                    session_start();
                    echo "<select name='class_name_id' >";
                    echo "<option disabled selected>Select Class</option>";

                        $records = mysqli_query($con, "SELECT DISTINCT (ClassName) from Class WHERE status = 1");

                        while($data = mysqli_fetch_array($records)) {
                            echo "<option value=" . $data["ClassName"] . ">" .$data["ClassName"] . "</option>";
                        }
                        
                    mysqli_close($con);  
                    //selecting class code end here  
                ?> 

                <input type='reset'>
                <input type='submit' name='submit'>

                

            </form>




        </div>

    </div>

    <script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter Name" required autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
</body>
</html>