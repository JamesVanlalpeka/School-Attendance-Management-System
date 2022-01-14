<?php
    include('../../db.php');
    session_start();

    $student_name = mysqli_real_escape_string($con,$_REQUEST['student_name']);
    $student_class = mysqli_real_escape_string($con,$_REQUEST['class_name_id']);



    //code to get the minimun primary key value of classcode in class table based on class name for foreign key in student table
    $class_code = "SELECT ClassCode from Class where ClassName='$student_class'";
    $class_code_result = mysqli_query($con, $class_code);
    $row_class_code = mysqli_fetch_array($class_code_result);
    $class_code_min_value = min($row_class_code);



    //to get the array of student name input from the users.
    $student_name = $_POST['title'];


    //inputting student in student table and login table
    foreach($student_name as $student_name_value){

    //code to take out the highest student id in the current class 

        $student_code = "SELECT studentId FROM Student WHERE className = '$student_class'";

        $student_code_result = mysqli_query($con, $student_code);

        $rowX = mysqli_fetch_array($student_code_result);
        $max_val = $rowX[0];

        foreach($student_code_result as $row){
            
            if($max_val < $row['studentId']){
                $max_val = $row['studentId'];
            }

        }

        if($max_val == NULL){
            $max_val = 1;
        }
        else{
            $max_val = $max_val + 1;
        }


        $sql = "INSERT INTO Student (studentId, studentName, classCode, className, status) VALUES
                ('$max_val','$student_name_value','$class_code_min_value','$student_class',1)";

        $sql_query_run = mysqli_query($con,$sql);

        $studentLogin = $max_val.$student_class;

        $sql1 = "INSERT INTO Login (loginId, password, flag, status) VALUES ('$studentLogin','".md5($studentLogin)."', 3, 1)";

        $sql1_query_run = mysqli_query($con,$sql1);



    }

    if($sql_query_run and $sql1_query_run) {
        echo "Record added successfully";

    } else {
        echo "ERROR: Could not able to execute $sql";

        mysqli_error($con);
    }

    mysqli_close($con);
?>
