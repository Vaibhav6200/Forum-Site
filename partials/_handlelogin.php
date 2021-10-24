<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
include '_dbconnect.php';
    $login_username = $_POST['loginusername'];
    $login_email = $_POST['loginemail'];
    $login_password = $_POST['loginpassword'];

    $sql = "SELECT * FROM `users` WHERE username = '$login_username' AND user_email = '$login_email'";
    $result = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($result);

    if($num == 1)
    {
        $row = mysqli_fetch_assoc($result);
        
        // if(password_verify($login_password , $row['user_password']))
        if($login_password == $row['user_password'])
        {
            session_start();
            // echo 'logged in susccessfully';
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['user'] = $login_username;
            header("location: /forum/index.php?loginsuccess=true");
        }
        else{
            $showError = "Invalid Credentials";
            header("location: /forum/index.php?loginsuccess=false&error=$showError");
        }
    }
    else{
        $showError = "Invalid Credentials";
        header("location: /forum/index.php?loginsuccess=false&error=$showError");
    }
}

?>