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
            min-height: 100vh /* this is done so that footer remains down  */
        }
    </style>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>



<!-- ADDING COMMENTS TO DATABASE  -->
    <?php  
        $successAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
    // now insert comment in database
            $comment_content = $_POST['comment'];

    // this is done so that koi apni website me javascript code inject kr k usko hack na kr le 
    // This will protect us from XSS attack
            $comment_content = str_replace("<" , "&lt;" , $comment_content);
            $comment_content = str_replace(">"  , "&gt;" , $comment_content);
            
            $thread_id = $_GET['thread_id'];
            

            $comment_by = $_SESSION['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment_content', '$thread_id', '$comment_by', current_timestamp());";
            $result = mysqli_query($conn , $sql);
            $successAlert = true;
        }

        if($successAlert == true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success! </strong> Your comment has been added successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    ?>




<!-- HEADER: fetching the thread of question which user have selected, to display question on header -->
    <?php   
        $thread_id = $_GET['thread_id'];    //thread_id is used to filter questions in a category and then we comment on that question  
        $sql = "SELECT * FROM `thread` WHERE thread_id=$thread_id";   //thread_id se vo question filter hota hai jispe hume comment krna hai
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_description'];

            // this is done to display "POSTED BY:" section on our comment page
            $thread_posted_by = $row['thread_user_id'];  
            $sql2 = "SELECT * FROM `users` WHERE sno ='$thread_posted_by'";
            $result2 = mysqli_query($conn , $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['username'];
        }
    ?>
    <div class="container-fluid">
        <div class="col-md-12 my-4 ">
            <div class="h-100 p-5 text-light fs-5 bg-dark rounded-3 d-flex flex-column justify-content-center ">
                <h1 class="fs-2rem"> <b>Que:</b> &nbsp;&nbsp;&nbsp; <?php echo $thread_title ?> </h1>
                <p> <b>Description:</b> &nbsp;&nbsp;&nbsp; <?php echo $thread_desc ?> </p> <!-- dynamically generating description of the thread -->
                <p class="d-inline fs-6">Posted by:  &nbsp; <em><?php echo $posted_by; ?></em> </p>
            </div>
        </div>
    </div>




<!-- POSTING COMMENT -->
    <?php   
        echo '<div class="container"><h1>Post a Comment</h1></div>';
        
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container my-4">
                <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">    <!-- agar hum same page pr post request maarna chahte hai, then do this -->
                    <div class="mb-3"> 
                    <div>
                        <label for="comment" class="form-label my-3">Type your comment</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary my-4">Post Comment</button>
                </form>
            </div>';
        }
        else{
            echo '
            <div class="container">
                 <div class="col-md-12 my-4 ">
                     <div class="h-100 p-5 text-light bg-secondary rounded-3">
                            <h1 class="fs-4"> Your are not Logged in please login to post a comment!</h1>
                       </div>
                    </div>
                </div>
             </div>';
        }
    ?>


<!-- FETCHING COMMENTS to show it in comment section of our page-->
    <div class="container" id="ques">
        <h2 class="py-4">Comments:</h2>
            <?php
                $thread_id = $_GET['thread_id'];
                $sql = "SELECT * FROM `comments` WHERE thread_id = $thread_id";
                $result = mysqli_query($conn, $sql);
                $noresult = true;  //this is don to show jumbotron to show "NO COMMENTS"

                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $comment_content = $row['comment_content'];
                    $comment_time = $row['comment_time'];
                    $noresult = false;  //since answer is present so no need to show jumbotron of no results

                    $comment_user_id = $row['comment_by'];
                    $sql2 = "SELECT username FROM `users` WHERE sno = '$comment_user_id'";
                    $result2 = mysqli_query($conn , $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $user = $row2['username'];

                    echo ' <div class="d-flex my-4">
                           <div class="flex-shrink-0 ">
                           <img src="img/user.png" width="54px" alt="...">
                           </div>
                                <div class="flex-grow-1 ms-3">
                                <p class="mb-0"><b>'. $user .'</b> at '. $comment_time .'</p>
                                   '. $comment_content .'
                                </div>
                           </div>';
                }

                if ($noresult) {
                    echo '<div class="container ">
                            <div class="col-md-12 my-4 ">
                                <div class="h-100 p-5 text-light bg-secondary rounded-3">
                                    <h1 class="fs-2rem">No Comment found</h1>
                                    <p class="fs-5"> please wait for community to respond </p>
                                </div>
                            </div>
                        </div>';
                }
            ?>
    </div>
    
    
<!-- FOOTER -->
    <?php include 'partials/_footer.php'; ?>

<!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>