<?php

	include('../db.php');
	session_start();


    $className = mysqli_real_escape_string($con,$_REQUEST['ClassName']);
    $subjectName = mysqli_real_escape_string($con,$_REQUEST['subjectName']);
    $date = mysqli_real_escape_string($con,$_REQUEST['date']);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=Attendance.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Roll no', 'Name', 'Status')); 
    
    $query1 = "SELECT Attendance.studentId, Student.studentName, Attendance.attendance FROM Attendance INNER JOIN Student ON Attendance.studentId = Student.studentId AND Attendance.className = Student.className WHERE Attendance.className = '$className' AND Attendance.subjectName = '$subjectName' AND Attendance.cur_date = '$date'";
    
    $query1_run = mysqli_query($con, $query1);

    while($row = mysqli_fetch_assoc($query1_run)){
        fputcsv($output, $row);
    }
    fclose($output);



?>


