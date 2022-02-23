<?php
  //connecting to db
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "crud";

  //create a connection
  $conn = mysqli_connect($servername, $username, $password, $database);

  if(!$conn){
      die("sorry we failed to coonnect: ". mysqli_connect_error());
  }

  if(isset($_GET['delete'])){
    $sno = $_GET['delete'];

    //sql query 
    $sql = "DELETE FROM `inote` WHERE `inote`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);

    if($result){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Your Note Is Deleted Successfully </strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Can Not Delete </strong>'.mysqli_error($conn).'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['editsno'])){
      //update the note
      $sno = $_POST['editsno'];
      $title = $_POST["edittitle"];
      $desc = $_POST["editdesc"];

      //sql query 
      $sql = "UPDATE `inote` SET `title` = '$title', `description` = '$desc' WHERE `inote`.`sno` = '$sno'";
      $result = mysqli_query($conn, $sql);

      if($result){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>One Note Updated</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Note Can not Updated </strong>'.mysqli_error($conn).'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }
    else{
      $title = $_POST["title"];
      $desc = $_POST["desc"];

      //sql query 
      $sql = "INSERT INTO `inote` (`title`, `description`, `tstamp`) VALUES ('$title', '$desc', current_timestamp())";
      $result = mysqli_query($conn, $sql);

      if($result){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>One Note Inserted</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Note Can not Inserted </strong>'.mysqli_error($conn).'
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
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">



  <title>iNote</title>



</head>

<body>


  <!-- Edit modal -->
  <!---<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button>--->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/inote/index.php" method="post">
          <div class="modal-body">


            <input type="hidden" name="editsno" id="editsno">
            <div class="mb-3">
              <label for="title" class="form-label">Note title</label>
              <input type="text" class="form-control" id="edittitle" name="edittitle" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Note description</label>
              <textarea class="form-control" id="editdesc" name="editdesc" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>



      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">iNote</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <form action="/inote/index.php" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Note title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Note description</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add note</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Time stamp</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
            //sql query 
            $sql = "SELECT * FROM `inote`";
            $result = mysqli_query($conn, $sql);

            //get the records returned
            $num = mysqli_num_rows($result);
            if($num > 0){
              $sno = 0;
              while($row = mysqli_fetch_assoc($result)){
                  //echo var_dump($row);
                  $sno++;
                  echo '<tr>
                  <th scope="row">'.$sno.'</th>
                  <td>'.$row['title'].'</td>
                  <td>'.$row['description'].'</td>
                  <td>'.$row['tstamp'].'</td>
                  <td><button class=" edit btn btn-sm btn-primary" id='.$row['sno'].'>Edit</button> <button class=" delete btn btn-sm btn-primary" id=d'.$row['sno'].'>Delete</button></td>
                  </tr>';
              }
            }
          ?>

      </tbody>
    </table>
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        edittitle.value = title;
        editdesc.value = description;
        editsno.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete");
        tr = e.target.parentNode.parentNode;
        sno = e.target.id.substr(1,);

        if (confirm("Are you sure you want to delete this note?")) {
          console.log("yes");
          window.location = `/inote/index.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })

  </script>

</body>

</html>