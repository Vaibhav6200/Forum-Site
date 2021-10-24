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
        #ques {
            min-height: 100vh;
            /* this is done so that footer remains down  */
        }
    </style>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

<!-- ADDING Questions TO DATABASE  -->
    <?php  
        $successAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        $cat_id = $_GET['catid'];    //cat_id is used to filter threads on basis of categories
        if($method == 'POST'){
    // now insert thread in database
            $title = $_POST['title'];
            $description = $_POST['description'];

    // this is done so that koi apni website me javascript code inject kr k usko hack na kr le 
    // This will protect us from XSS attack
            $title = str_replace("<" , "&lt;" , $title);
            $title = str_replace(">"  , "&gt;" , $title);
            $description = str_replace("<" , "&lt;" , $description);
            $description = str_replace(">"  , "&gt;" , $description);


    // To show username above his question
            $thread_user_id = $_SESSION['sno'];

            $sql = "INSERT INTO `thread` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$description', '$cat_id', '$thread_user_id', current_timestamp());";
            $result = mysqli_query($conn , $sql);
            $successAlert = true;
        }

        if($successAlert == true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success! </strong> Your thread has been added successfully, wait untill someone respond
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    ?>

    <?php
    // here we are fetching category name and its description from CATEGORY table to display it on top of forum
        $cat_id = $_GET['catid'];  //cat_id is used to filter threads on basis of categories
        $sql = "SELECT * FROM `categories` WHERE category_id=$cat_id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>


<!-- Header -->
    <div class="container-fluid">
        <div class="col-md-12 my-4 ">
            <div class="h-100 p-5 text-white fs-5 bg-dark rounded-3 d-flex flex-column justify-content-center align-items-center">
                <h1 class="text-center fs-2rem">Welcome to <?php echo $catname ?> form</h1>
                <p> <?php echo $catdesc ?> </p> <!-- dynamically generating description -->
            </div>
        </div>
    </div>


<!-- THREADLIST FORM -->
<!-- agar hum same page pr post request maarna chahte hai, then do this -->
<!-- <?php echo $_SERVER['REQUEST_URI'] ?> this will return the complete uri of the page on which we are standing   URL me ?catid=1 ye nhi aa rha tha -->

    <?php  

        echo '<div class="container"><h1>Start a Discussion</h1></div>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '
            <div class="container my-4">
            <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">    
                <div class="mb-3">                                                  
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" id="title" name="title" class="form-control" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">keep your title as short as possible</div>
                </div>
                
                <div>
                    <label for="description" class="form-label my-3">Elaborate your concern</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary my-4">Submit</button>
            </form>
        </div>';
        }
        else{
            echo '
            <div class="container">
                 <div class="col-md-12 my-4 ">
                     <div class="h-100 p-5 text-light bg-secondary rounded-3">
                     <h1 class="fs-4"> Your are not Logged in please login to start a discussion</h1>
                            <p> </p>
                       </div>
                    </div>
                 </div>
            </div>';
        }
    ?>




<!-- Browsing Questions -->
    <div class="container" id="ques">
        <h2 class="py-4">Browse Question</h2>
        <?php
        //here we are fetching all questions of given category_id  from THREAD table  
        $cat_id = $_GET['catid'];  //cat_id is used to filter threads on basis of categories
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id = $cat_id";
        $result = mysqli_query($conn, $sql);
        $noresult = true;       //this is done so that if no answer (or comment) is present in the thread then we will show a jumbotron 

        while ($row = mysqli_fetch_assoc($result)) {
            $thread_id = $row['thread_id'];  //thread_id is used to filter questions in a category 
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            $thread_time = $row['timestamp'];
            $noresult = false;  //since answer is present so no need to show jumbotron of no results

        $thread_user_id = $row['thread_user_id'];   // isse hume jis user ne comment kiya hai uska sno mil jayega (id)
        $sql2 = "SELECT username FROM `users` WHERE sno = '$thread_user_id'";
        $result2 = mysqli_query($conn , $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $user = $row2['username'];

            echo ' <div class="d-flex my-4 ">
                    <div class="flex-shrink-0">
                        <img src="img/user.png" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0"><b>'. $user .'</b> at '. $thread_time .'</p>
                        <h4> <a href="thread.php?thread_id=' . $thread_id . '">' . $title . '</a> </h4> ' . $desc . '
                    </div>
                   </div>';
        }

        if ($noresult) {
            echo '<div class="container ">
                    <div class="col-md-12 my-4 ">
                        <div class="h-100 p-5 text-light bg-secondary rounded-3">
                            <h1 class="fs-2rem">No threads found</h1>
                            <p> Be the first person to start thread </p>
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