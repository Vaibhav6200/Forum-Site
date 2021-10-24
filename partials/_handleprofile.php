<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include '_dbconnect.php';
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $about = $_POST['about'];

// getting error 
    $user_id = $_SESSION['sno'];
        
        $sql2 = "UPDATE `users` SET `full_name` = '$fullname', `user_email` = '$email', `user_bio` = '$about' WHERE `sno` = '$user_id'";
        $result2 = mysqli_query($conn , $sql2);
        // header("location: /forum/profile.php");
        echo "Success ";
}

?>

