<?php
//	include('../../auth.php');
	include('../db.php');
	session_start();
?>

<!DOCTYPE html>
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

	<a class="nav-link text-light font-weight-bold px-3" href="teacher.php"><i class="fas fa-home"></i>HOME</a>

	</li>


<!-- Display Attendance-->
<li class="nav-item">

<a class="nav-link text-light font-weight-bold px-3 " href="displayattendance.php" id="navbarDropdown" role="button" >Display Attendence</a>

</li>

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
                    <input type="reset">
                    <input type="submit" name="submit">

                </form>
        </div>

        </div>


</li>

<!-- logout -->
<li class="nav-item">
   
<a class="nav-link text-light font-weight-bold px-3  " href="../logout.php">Logout</a>

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

                

            echo"<form action='export.php' method='post'>";
                if(isset($_POST["subject_name_id"])) {
                    $subjectName = $_POST['subject_name_id'];
                    $className = $_POST['class_name'];
                    $date = $_POST['date'];

                    echo $className;
                    echo "<br>";
                    echo $subjectName;
                    echo "<br>";
                    echo $date;
                    echo "<br>";

                    echo "<input type='hidden' name='ClassName' value='$className'>";
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
     
                        echo"<input type='submit' name='export' value='Export'>";
                    
                }
            echo "</form>";



        ?>

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

