<?php

include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:index.php');
}

?>
    <?php
        
        $select_cart_number = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'")
        or die('query failed');
    
    ?>


    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="adminstyle.css">
</head>
<body>

        <div class="logs">
            <div class="logs-container">
                <p><a href="logout.php">logout</a></p>
                <p><a href="admin_home.php">Admin Page</a></p>
            </div>
     
        </div>
        
    
    <div class="container mt-5">

        <?php
        
            include('message.php');

        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Details
                            <a href="add_customer.php" class="btn btn-primary float-end">Add Customers</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Userame</th>
                                <th>DOB</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Address</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM customers";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0 )
                                {
                                    foreach($query_run as $cust)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $cust['id']; ?></td>
                                            <td><?= $cust['first_name']; ?></td>
                                            <td><?= $cust['last_name']; ?></td>
                                            <td><?= $cust['username']; ?></td>
                                            <td><?= $cust['dob']; ?></td>
                                            <td><?= $cust['email']; ?></td>
                                            <td><?= $cust['telephone']; ?></td>
                                            <td><?= $cust['address']; ?></td>
                                            <td><img src="images/<?php echo $cust['image'];?>" height="50px" width="50px" alt=""></td>
                                            <td>
                                                <a href="view_customers.php?id=<?= $cust['id']  ?>" class="btn btn-info btn-sm">View</a>
                                                <a href="edit_customers.php?id=<?= $cust['id']  ?>" class="btn btn-success btn-sm">Edit</a>
                                                
                                                <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_customer" value="<?= $cust['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }
                                else
                                {
                                    echo "<h5>No Records Found</h5>";
                                }
                            ?>
                            
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>