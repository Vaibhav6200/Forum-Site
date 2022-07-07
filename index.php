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
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

<!-- CAROUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?coding,programming" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?microsoft,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programmer,google" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    
    <div class="container" id="ques">
        <h1 class="text-center my-3">V-Threads | Browsing Categories</h1>
        <div class="row">

<!-- BROWSING CATEGORIES | CARDS -->
            <?php
                include 'partials/_dbconnect.php';
        // now we are telling to give me all categories from the database which we have connected
                $sql = "SELECT * FROM `subjects`";
                $result = mysqli_query($conn, $sql);
        // now we will fetch all categories and will display it on home screen using loop
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['subject_id'];   
                    $name = $row['subject_name'];   // storing category name in a variable so that we can display it in title
                    $desc = $row["subject_description"];
                echo '
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/500x400/?coding,'.$name.'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title "><a class="text-decoration-none" href="Home.php?subid='.$id.'">' . $name . '</a></h5>
                            <p class="card-text">'. substr($desc , 0 , 90) .'...</p>
                            <a href="Home.php?subid='.$id.'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
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