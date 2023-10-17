<?php
    require 'common.php';
    $student_id=$_POST['student_id'];
    $password=$_POST['password'];
    
    $q="select student_id,password FROM users WHERE student_id='$student_id' AND password='$password'";
    $query= mysqli_query($con, $q);
    $rows= mysqli_num_rows($query);
    
    if($rows>0)
    {
        $_SESSION['student_id'] = mysqli_fetch_array($query)['student_id'];
        header("Location: ../home.php");
    }
    
    else 
    {
        header("Location: ../index.php?error");
    }
?>