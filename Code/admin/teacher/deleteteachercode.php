<?php
    include('../../db.php');
    session_start();

    if(isset($_POST['stud_delete_multiple_btn'])) {

        $all_TeacherId = $_POST['stud_delete_id'];

        $extract_TeacherId = implode(',' , $all_TeacherId);


        // Attempt update query execution
        $query = "UPDATE Class SET TeacherId = NULL, TeacherName = 'NULL' WHERE TeacherId IN ($extract_TeacherId)";
        $query_run = mysqli_query($con,$query);

        
        $query1 = "UPDATE Teacher SET status = 0 WHERE TeacherId IN ($extract_TeacherId)";
        $query_run1 = mysqli_query($con,$query1);

        
        foreach($all_TeacherId as $value){

            $deleteLoginTeacherId = $value."Faculty";
            echo "$deleteLoginTeacherId";
            $query2 = "UPDATE Login SET status=0 WHERE loginId ='$deleteLoginTeacherId' ";
            $query_run2 = mysqli_query($con,$query2);
            
        }


        if($query_run and $query_run1 and $query_run2) {
            $_SESSION['status'] = "Data Deleted Successfully";
            header("Location: deleteTeacher.php");

        }
        else{
            $_SESSION['status'] = "Data Not Deleted";
            header("Location: deleteTeacher.php");
        }
            

    }
    mysqli_close($con);    
?>