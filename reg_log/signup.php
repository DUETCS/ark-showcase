<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["password"] != $_POST["cpassword"]){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Password do not match</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else{
            include 'partials/_dbconnect.php';
            
            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`sno`, `username`, `password`, `dt`) VALUES (NULL, '$username', '$passwordHash', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if(!$result){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error! </strong>'.mysqli_error($conn).'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            else{
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success! </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        
    }
?>



    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Sign Up</title>
    </head>

    <body>
        <?php require 'partials/_nav.php' ?>

        <div class="container">
            <h1 class="text-center">Sign Up</h1>

            <form action="/reg_log/signup.php" method="post">

                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    
                </div>

                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="cpassword" class="form-label">Re-Type Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                    <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
                </div>

                <button type="submit" class="btn btn-primary">SignUp</button>

            </form>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    </body>

    </html>