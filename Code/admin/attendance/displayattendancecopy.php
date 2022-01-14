<?php
//	include('../../auth.php');
	include('../db.php');
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>

  

    </head>
    <body>



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


    </body>
</html>

