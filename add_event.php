

<?php
include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>

<div class="container mt-5">

<?php
include('message.php');
?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Event <a href="event.php" class="btn btn-danger float-end">BACK</a> </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                       <div class="mb-3">
                        <label for="name">Event Name</label>
                        <input type="text" name="name" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="date">Date of Event</label>
                        <input type="date" name="date" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="Image">Image</label>
                        <input type="file"  name="image" accept="image/jpg, image/jpeg, image/png" class="form-control">
                       </div>

                       <div class="mb-3">
                        <button type="submit" name="save_event" class="btn btn-primary" >Add</button>
                       </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>