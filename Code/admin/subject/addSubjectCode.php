<?php
    include('../../db.php');
    session_start();

    $subject_name = mysqli_real_escape_string($con,$_REQUEST['subject_name']);
    $subject_code = mysqli_real_escape_string($con, $_REQUEST['subject_code']);

    $sql = "INSERT INTO Subject (SubjectCode, SubjectName, status) VALUES
            ('$subject_code','$subject_name', 1)";

    if(mysqli_query($con, $sql)) {
        echo "Record added successfully";

    } else {
        echo "ERROR: Could not able to execute $sql";

        mysqli_error($con);
    }

    mysqli_close($con);
?>