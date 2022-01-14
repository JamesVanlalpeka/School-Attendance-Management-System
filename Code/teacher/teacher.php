<?php
	include('../auth.php');
	include('../db.php');
	session_start();

    $user = $_SESSION['username'];
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
        
        <script type="text/javascript">  //JS code to mark all checkbox
            function toggle(source) {
            checkboxes = document.getElementsByName('attendance[]');

            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }          
        </script> 
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
		<h3>Take Attendance</h3>



            <form action="" method="post">
                <?php
//displaying class list name
                    $query = "SELECT DISTINCT  ClassName FROM Class WHERE status = 1";
                    $query_run = mysqli_query($con,$query);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                 ?>
                        <select name = "class_name_id" required>
                        	<option value="" selected disabled hidden>Select Class</option>
                <?php
                        foreach($query_run as $row)
                        {
                ?>
		                    <option value="<?= $row['ClassName']; ?>"><?= $row['ClassName']; ?></option>
                <?php
                        }
                        echo"</select>";
                ?>
                <?php
                    }
               
                    else {
                ?>
                    	<p>No Record Found</p>
                <?php
                    }
                ?>
                <input type="submit" value="Submit">
        </form>


    <?//..........................................................................?>

        <?php
            if(isset($_POST["class_name_id"])) {


                $class_name = $_POST['class_name_id'];
                echo "<p>" . $class_name . "</p>";  //display class name

                echo "<form action='' method='post'>";
                    $query = "SELECT SubjectCode, SubjectName FROM Class WHERE ClassName = '$class_name' AND status = 1";
                    $query_run = mysqli_query($con, $query);

                    $query1 = "SELECT studentId, studentName FROM Student WHERE className='$class_name' AND status = 1";
                    $query_run1 = mysqli_query($con,$query1);

                    echo "<input type='hidden' name='className' value='$class_name'>";

//displaying subject drop down code


                    if(mysqli_num_rows($query_run) > 0){
        ?>
                        <select name = 'subject_name_id' required>  
                            <option value='' selected disabled hidden>Select Subject</option>
        <?php
                            foreach($query_run as $row) {
        ?>
                                <option value="<?= $row['SubjectName']; ?>"><?= $row['SubjectName']; ?></option>
        <?php           
                            }
        ?>
                        </select>

                        <br/><br/>

                        <input type = 'date' name = 'inputDate' required>

                        <br/><br/>

        <?php
                    }
                    else {
                        echo" <p>No Record Found</p>";
                    }



//displaying student list


                    echo "<table style='border-style:solid; border-color:black';>";
                        echo"<tr>";
                            echo" <th>Roll no.</th>";
                            echo" <th>Name</th>";
                            echo" <th>Status <input type='checkbox' onClick='toggle(this)' checked='true'/></th>";
                        echo" </tr>";

                        if(mysqli_num_rows($query_run1) > 0) {
                            foreach($query_run1 as $row){
        ?>
                                <tr>
                                    <td>    <?= $row['studentId']; ?>     </td>
                                    <td>    <?= $row['studentName']; ?>     </td>
                                    
                                    <td>    <input type="checkbox" name="attendance[]" value="1" checked='true'>   </td>
                                    <td>    <input type="hidden" name="attendance[]" value="0"> </td>
                                </tr>
        <?php
                            $studentIdArray[] = $row['studentId'];
                        }
                            $_SESSION['studentId']=$studentIdArray;
                        }
                    echo "</table>";

                        echo "<input type='submit' name=submit>";
                        
                echo "</form>";
            
            }

            //..........................................................................


            if(isset($_POST["subject_name_id"])) {
                $attendance = $_POST['attendance'];
                $subject = $_POST['subject_name_id'];
                $className = $_POST['className'];
                $student = $_SESSION['studentId'];
                $date = $_POST['inputDate'];

                $flag = "NULL";
                $count_student = 0;
                $count_attendance = 0;

                echo $className;
                echo"</br>";
                echo $subject;
                echo"</br>";
                echo $date;
                echo"</br>";


                while($count_attendance < count($attendance)){   

                    if($attendance[$count_attendance] == 1){
                        $flag = "Present";
                        $count_attendance = $count_attendance + 2;
                    }
                    else{
                        $flag = "Absent";
                        $count_attendance = $count_attendance + 1;
                    }

                    $PK = "SELECT MAX(pKey) FROM Attendance";   //fetch the highest in the primary attribute
                    $PK_run = mysqli_query($con, $PK);

                    $row = mysqli_fetch_array($PK_run);
                    if($row[0] == NULL){
                        $row[0] = 1;
                    }
                    else{
                            $row[0] = $row[0] + 1;
                    }

                    $queryx = "INSERT INTO Attendance(pKey, studentId, className, subjectName, cur_date, attendance) 
                    VALUES ('$row[0]','$student[$count_student]', '$className', '$subject','$date','$flag')";
                    $query_runx = mysqli_query($con, $queryx);

                    $count_student = $count_student + 1;
                }


                if($query_runx) {
                    echo " Attendance Recorded Successfully";
                }
                else{
                    echo " Attendance Recorded Failed";
                }

            }

        ?>
        <br><br>

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
</div>
	</body>
</html>