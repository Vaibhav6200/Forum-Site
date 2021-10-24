<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .container {
            height: auto;
            width: 40%;
        }
    </style>
    <title>Contact Us</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>


<!-- Listening to post request -->
        <?php
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            include 'partials/_dbconnect.php';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            $sql = "INSERT INTO `contact` (`name`, `email`, `phone`, `message`, `date`) VALUES ('$name', '$email', '$phone', '$message', current_timestamp())";
            $result = mysqli_query($conn , $sql);

            if($result){
                echo '  <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                            <strong>Success! </strong> Your message has been recorded
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            else{
                echo '  <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                            <strong>Error! </strong> Due to some technical issues your message is not recorded. Please try again after some time. Sorry for the inconvenience
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        }    
        
        ?>


<!-- CONTACT  FORM -->
    <div class="container d-flex flex-column my-5 ">
        <h1 class="my-3 mb-4">Contact Us!</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="my-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
            </div>
            <div class="my-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email" required>
            </div>
            <div class="my-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="my-3 ">
                <label for="message" class="form-label my-3">Elaborate your concern</label>
                <textarea class="form-control" id="message" name="message" spellcheck="false" placeholder="Enter your message" required></textarea>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary my-5">Submit</button>
            </div>
        </form>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- <?php include 'partials/_footer.php'; ?> -->
</body>

</html>