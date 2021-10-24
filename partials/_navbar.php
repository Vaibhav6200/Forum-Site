<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 2.8rem;">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">V-Threads</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active px-3" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3" href="about.php">About Us</a>
      </li>

      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Top Categories
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

        include '_dbconnect.php';
        $sql = "SELECT * FROM `subjects` LIMIT 5";
        $result = mysqli_query($conn , $sql);

        while($row = mysqli_fetch_assoc($result))
        {
          $sub_name = $row['subject_name'];
          $sub_id = $row['subject_id'];
          echo '<li><a class="dropdown-item"  href="Home.php?subid='.$sub_id.'">'. $sub_name .'</a></li>';
        }

echo '  
        </ul>
      </li> 
        <li class="nav-item">
          <a class="nav-link px-3" href="contact.php">Contact Us</a>
        </li>
    </ul>';



    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '  <form class="d-flex align-items-center justify-content-center" action="/forum/search.php?search=search" method="get">
                  <p class="text-light my-0 text-center" style="min-width: 260px;" >Welcome: '. $_SESSION['user'] .'</p>

       <input class="form-control my-1 mx-2 py-0 btn-sm" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-sm btn-success btn-md  mx-1" type="submit">Search</button>
                  <a href="/forum/partials/_logout.php" class="btn btn-sm btn-outline-success mx-2">Logout</a>      
              </form>
              
      <a href="/forum/profile.php" class="btn btn-dark py-1 px-1 mx-0"> <img src="/forum/img/profile.png" width="45px" alt="" style="filter: invert(1);"> </a>
        ';
    }

    else{
      echo '  <form class="d-flex" min-width = 42% action="/forum/search.php?search=search" method="get">
                <input class="form-control my-1 mx-2 py-0 btn-sm" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success btn-sm btn-md  mx-1" type="submit">Search</button>
            <button type="button" class="btn btn-sm btn-outline-success mx-2"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>      
            <button type="button" class="btn btn-sm btn-outline-success mx-1"  data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
            </form>';
    }

    echo '
      </div>
    </div>
  </nav>';



    include 'partials/_loginModal.php';
    include 'partials/_signupModal.php';

    // These are the alerts which will be showed if user successfully loggs in
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                  <strong>Success! </strong> You have successfully signed in
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false")
    {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                  <strong>Error! </strong> '. $_GET['error'] .'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                  <strong>Success! </strong> You have successfully Logged in
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false")
    {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                  <strong>Error! </strong> '. $_GET['error'] .'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
?>