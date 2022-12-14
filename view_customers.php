
<?php

include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Information</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Details <a href="admin_page.php" class="btn btn-danger float-end">BACK</a> </h4>
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
                                
                            <form action="code.php" method="POST">

                                <input type="hidden" name="id" value="<?= $customer_id?>" >

                            <div class="mb-1">
                                <label for="Customer First Name">First Name:</label>
                               
                                <p>
                                <?= $customer['first_name'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="Customer Last Name"> Last Name:</label>
                                <p>
                                <?= $customer['last_name'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="Customer Username">Username:</label>
                               
                                <p>
                                <?= $customer['username'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="Customer Date of birth">Date of birth:</label>
                               
                                <p>
                                <?= $customer['dob'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="Customer email">Email:</label>
                               
                                <p>
                                <?= $customer['email'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="Customer Number">Phone Number:</label>
                                
                                <p>
                                <?= $customer['telephone'];?>
                                </p>
                            </div>

                            <div class="mb-1">
                                <label for="">Address:</label>
                               
                                <p>
                                <?= $customer['address'];?>
                                </p>
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