<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>V-Threads forum</title>
    <style>
        #ques{
            min-height: 100vh; /* this is done so that footer remains down  */
        }
    </style>

    <script>
        function hide(){
                let reset_pass = document.getElementById('reset_pass');
                let form = document.getElementById('form');
                
                if(form.style.display != 'none'){
                    form.style.display = 'none';
                }
                else{
                    form.style.display = 'block';
                }
            }
    </script>
    
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>


<div class="container">
  <div class="col">
    <div class="row">

      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">

              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">

        <!-- Adding username dynamically on profile Page -->
                  <?php 
                    include 'partials/_dbconnect.php';
                    $user_id = $_SESSION['sno'];
                    $sql = "SELECT * FROM `users` WHERE sno = '$user_id'";
                    $result = mysqli_query($conn , $sql);
                    $row = mysqli_fetch_assoc($result);
                    $username = $row['username'];  
                    $full_name = $row['full_name'];
                    $signin_date = $row['signin_date'];
                  ?> 

                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"> <?php echo $username ?> </h4>
                    <p class="mb-0"> <?php echo $full_name ?> </p>
                    <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                    <div class="mt-2">

                      <button class="btn btn-primary" type="button">
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                      </button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">administrator</span>
                    <div class="text-muted"><small>Joined  <?php echo $signin_date ?> </small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul> 
              <!-- <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" novalidate=""> -->



<!-- Edit Profile Section -->
            <form action="partials/_handleprofile.php" method="POST">
                    <div class="row">
                      <div class="col">
                <!-- Full Name -->
                        <div class="row">
                          <div class="col-5">
                            <div class="form-group">
                              <label for="full_name" class="form-label">Full Name</label>
                              <input class="form-control" type="text" name="full_name" id="full_name" placeholder="enter your full name">
                            </div>
                          </div>
                <!-- Email -->
                              <div class="col-7">
                                  <div class="form-group">
                                      <label for="email" class="form-label">Email</label>
                                      <input class="form-control" name="email" id="email" type="email" placeholder="enter your email">
                                    </div>
                                </div>
                            </div>
                        </div>
                <!-- About -->
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label for="about" class="form-label">About</label>
                              <textarea class="form-control" name="about" id="about" rows="5" placeholder="My Bio"></textarea>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
                <button class="btn btn-primary mb-5" type="submit">Save Changes</button>
            </form>


<!-- Change Password Section -->

                        <div class="modal-body">
                            <form action="/forum/partials/_handlelogin.php" id="form" method="POST" style="display: none;">
                                 <div class="mb-1 col-5">
                                     <label for="current_password" class="form-label">Current Password</label>
                                     <input type="password" class="form-control" id="current_password" name="current_password" required>
                                 </div>
                                 <div class="mb-1 col-5">
                                     <label for="password" class="form-label">Password</label>
                                     <input type="password" class="form-control" id="password" name="password" required>
                                 </div>
                                 <div class="mb-1 col-5">
                                     <label for="cpassword" class="form-label">Confirm Password</label>
                                     <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                                     <div id="emailHelp" class="form-text">Make sure to enter the same password</div>
                                 </div>
                                     <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                        <button id="reset_pass" class="btn btn-primary" onclick="hide()">Reset Password</button>


                <!-- </div> -->
              <!-- </div> -->
              
            </div>
          </div>
        </div>
      </div>

        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">Support</h6>
            <p class="card-text">Get fast, free help from our friendly assistants.</p>
            <a href="contact.php" class="btn btn-primary">Contact Us</a>
          </div>
        </div>
        

      </div>
    </div>

  </div>
</div>
</div>
</div>

<!-- FOOTER -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  
</body>

</html>