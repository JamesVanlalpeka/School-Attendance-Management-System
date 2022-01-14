<?php
    include('../../db.php');
    session_start();

    if(isset($_POST['stud_delete_multiple_btn'])) {

        $all_SubjectCode = $_POST['stud_delete_id'];

        $extract_SubjectCode = implode(',' , $all_SubjectCode);
        
        $query = "UPDATE Subject SET status = 0 WHERE SubjectCode IN($extract_SubjectCode)";
        $query_run = mysqli_query($con,$query);

        if($query_run) {
            $_SESSION['status'] = "Data Deleted Successfully";
            header("Location: deleteSubject.php");

        }
        else{
            $_SESSION['status'] = "Data Not Deleted";
            header("Location: deleteSubject.php");
        }


    }
    mysqli_close($con);
?>
