<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $fullname = $_POST['signupFullname'];
    $username = $_POST['SignupUsername'];
    $email = $_POST['SignupEmail'];
    $password = $_POST['SignupPassword'];
    $cpassword = $_POST['SignupCpassword'];

    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn , $sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        $showError = "Username already exist";
    }
    else{
        if($password == $cpassword){
            // $hash = password_hash($password , PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`full_name`,`username`, `user_email`, `user_password`, `signin_date`) VALUES ('$fullname','$username', '$email', '$password', current_timestamp());";
            $result = mysqli_query($conn ,$sql);
            if($result){
                header("location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "passwords do not match";
        }
    }
    header("location: /forum/index.php?signupsuccess=false&error=$showError");
}

?>