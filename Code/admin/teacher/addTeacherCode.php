


<?php

    include('../../db.php');
    session_start();

    $teacher_name = mysqli_real_escape_string($con,$_REQUEST['teacher_name']);

    $teacher_code = "SELECT TeacherId FROM Teacher";   //fetch the highest id in the column teacherId
    $teacher_code_result = mysqli_query($con, $teacher_code);

    $rowX = mysqli_fetch_array($teacher_code_result);
    $max_val = $rowX[0];

    foreach($teacher_code_result as $row){
        
        if($max_val < $row['TeacherId']){
            $max_val = $row['TeacherId'];
        }

    }

    if($max_val == NULL){
        $max_val = 1;
    }
    else{
            $max_val = $max_val + 1;
    }

    $sql = "INSERT INTO Teacher (TeacherId, TeacherName, status) VALUES ('$max_val','$teacher_name', 1)";

    $teacherCheck = mysqli_query($con, $sql);

    //code to insert into login table begin here

    $teacherLoginId = $max_val."Faculty";

    $sqlLogin = "INSERT INTO Login (loginId, password, flag, status) VALUES ('$teacherLoginId','".md5($teacherLoginId)."', 2, 1)";

    $loginCheck = mysqli_query($con , $sqlLogin);

    //end here

    if($teacherCheck and $loginCheck) {
        echo "Record added successfully";

    } else {
        echo "ERROR: Could not able to execute $sql";

        mysqli_error($con);
    }

    mysqli_close($con);    
?>
