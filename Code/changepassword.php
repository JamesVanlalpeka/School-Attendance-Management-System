<DOCTYPE html>
<html>
<head>
	<style>
	</style>
<head>
<body>

    <?php
        include('auth.php'); //include auth.php file on all secure pages
        require('db.php');
        session_start();


        $newPassword = mysqli_real_escape_string($con,$_REQUEST['password1']);
        $loginId = mysqli_real_escape_string($con,$_REQUEST['loginId']);


        $passwordQuery = "UPDATE Login SET password = '".md5($newPassword)."' WHERE loginId = '$loginId'";
        $passwordQuery_run = mysqli_query($con,$passwordQuery);

        if($passwordQuery){
            echo "Password change successfully";

        } else {
            echo "ERROR: Could not able to execute $sql";
            mysqli_error($con);
        }
    
        mysqli_close($con);

    ?>



</body>
</html>