<?php

//connecting to db
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

//create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("sorry we failed to coonnect: ". mysqli_connect_error());
}

?>