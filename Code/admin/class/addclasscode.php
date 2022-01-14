<?php
    include('../../db.php');
    session_start();

    if(isset($_POST['stud_add_multiple_btn'])) {

        $all_TeacherId = $_POST['teacher_add_id'];

        $all_SubjectCode = $_POST['subject_add_id'];


        $class_name = mysqli_real_escape_string($con,$_REQUEST['class_name']);
        $class_name = str_replace(' ','',$class_name);


        for ($i=0; $i < count($all_SubjectCode); $i++) {

            $teacherName = "SELECT TeacherName from Teacher WHERE TeacherId = '$all_TeacherId[$i]'";
            $allTeacherName = mysqli_query($con,$teacherName);  //retriving teacher name from teacher table


            $subjectName = "SELECT SubjectName from Subject WHERE SubjectCode ='$all_SubjectCode[$i]'";
            $allSubjectName = mysqli_query($con,$subjectName);  //retriving subject name from subject table
        
            foreach ($allTeacherName as $TeacherValue) {
                $Teacher = $TeacherValue['TeacherName'];

                foreach($allSubjectName as $SubjValue) {
                    $Subject = $SubjValue['SubjectName'];


                    $query = "INSERT INTO Class (ClassName, SubjectCode, TeacherId, TeacherName,SubjectName, status) VALUES
                        ('$class_name','$all_SubjectCode[$i]','$all_TeacherId[$i]','$Teacher','$Subject',1)";
                        $result = mysqli_query($con,$query);
                }

            }
        }

        if($result) {
            echo "Successfully";
        }

        else {
            echo "Failed";
        }

    }
    mysqli_close($con);
?>