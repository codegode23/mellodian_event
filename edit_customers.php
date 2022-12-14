
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
<title>Edit Customer</title>
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
                    <h4>Edit Customer <a href="admin_page.php" class="btn btn-danger float-end">BACK</a> </h4>
                </div>
                <div class="card-body">

                    <?php
                    
                        if(isset($_GET['id']))
                        {
                            $customer_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM customers WHERE id='$customer_id'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $customer = mysqli_fetch_array($query_run);
                                ?>
                                
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="id" value="<?= $customer_id?>" >

                            <div class="mb-3">
                                <label for=" fName">First Name</label>
                                <input type="text" name="fname" value="<?= $customer['first_name'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for=" lName">Last Name</label>
                                <input type="text" name="lname" value="<?= $customer['last_name'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for=" uName">Username</label>
                                <input type="text" name="username" value="<?= $customer['username'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for=" dob">Date of birth</label>
                                <input type="date" name="dob" value="<?= $customer['dob'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for=" email">Email</label>
                                <input type="text" name="email" value="<?= $customer['email'];?>" class="form-control">
                            </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="number" name="tel" value="<?= $customer['telephone'];?>" class="form-control">
                            </div>

                            
                            <div class="mb-3">
                                <label for=" address">Address</label>
                                <input type="text" name="address" value="<?= $customer['address'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="images">Images</label>
                                <input type="file"  name="image" accept="image/jpg, image/jpeg, image/png">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_customer" class="btn btn-primary" >Update customer</button>
                            </div>

                            </form>

                            <?php
                            }
                            else
                            {
                                echo "<h5>No Such Id Found</h5>";
                            }
                        }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>






<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>