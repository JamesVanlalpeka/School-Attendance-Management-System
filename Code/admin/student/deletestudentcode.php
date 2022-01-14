<?php

    include('../../db.php');
    session_start();

//code to delete student start here
    if(isset($_POST['stud_delete_multiple_btn'])) {

        $all_StudentId = $_POST['stud_delete_id'];
        $class_name = $_POST['className'];
        
        $extract_StudentId = implode(',' , $all_StudentId);                        
        
        $query1 = "UPDATE Student SET status = 0 WHERE studentId IN($extract_StudentId) AND className = '$class_name'";
        $query_run1 = mysqli_query($con,$query1);
        
        
        foreach($all_StudentId as $value){
        
            $deleteLoginStudentId = $value.$class_name;
        
            $query2 = "UPDATE Login SET status = 0 WHERE loginId = '$deleteLoginStudentId' ";
            $query_run2 = mysqli_query($con,$query2);
            
        }
                
        
        if($query_run1 and $query_run2) {
            $_SESSION['status'] = "Data Deleted Successfully";
            header("Location: deletestudent.php");
        
        }
        else{
            $_SESSION['status'] = "Data Not Deleted";
            header("Location: deletestudent.php");
        }
            
        
        }   //code to delete student end here

        mysqli_close($con);  

?>