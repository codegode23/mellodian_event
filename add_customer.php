

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
                    <h4>Add New Customer <a href="admin_page.php" class="btn btn-danger float-end">BACK</a> </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">

                       <div class="mb-3">
                        <label for="fName">First Name</label>
                        <input type="text" name="fname" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="lName">Last Name</label>
                        <input type="text" name="lname" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="uName">Userame</label>
                        <input type="text" name="username" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="password">password</label>
                        <input type="text" name="password" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="date">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="phone">Phone Number</label>
                        <input type="number" name="tel" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="house no">House Number</label>
                        <input type="text" name="house_num" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="Street Name">Street Name</label>
                        <input type="text" name="street_name" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="Post code">Post Code</label>
                        <input type="text" name="post_code" class="form-control">
                       </div>

                       <div class="mb-3">
                        <label for="Image">Customer Image</label>
                        <input type="file"  name="image" accept="image/jpg, image/jpeg, image/png" class="form-control">
                       </div>

                       <div class="mb-3">
                        <button type="submit" name="save_customer" class="btn btn-primary" >Save Customer</button>
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