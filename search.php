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
        .container {
            min-height: 100vh;
            /* this is done so that footer remains down  */
        }
    </style>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

    <div class="container my-3">
        <h1 class="py-2">Search results for <em>"<?php echo $_GET['search']; ?>"</em> </h1>

        <?php
            include 'partials/_dbconnect.php';
            $query = $_GET['search'];   //this query is to be searched
            $sql = "SELECT * FROM thread WHERE MATCH ( thread_title , thread_description ) against ('$query')";
            $result = mysqli_query($conn , $sql);
            $num = mysqli_num_rows($result);

            if($num > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $title = $row['thread_title'];
                    $description = $row['thread_description'];
                    $thread_id = $row['thread_id'];

                    echo '<div class="searchResult">
                    <h3><a href="thread.php?thread_id=' . $thread_id . '" class="text-decoration-none"> '. $title .' </a></h3>
                    <p>'. $description .'</p>
                    </div>';
                }
            }
            else{
                echo '  <div class="container">
                            <div class="col-md-12 my-4 ">
                                <div class="h-100 p-5 text-light bg-secondary rounded-3">
                                    <h1 class="fs-1"> No Results found</h1>
                                    <h4>Suggestions:<br></h4>
                                    <ul>
                                        <li>Make sure that all words are spelled correctly.</li>
                                        <li>Try different keywords.</li>
                                        <li>Try more general keywords.</li>
                                    </ul>
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