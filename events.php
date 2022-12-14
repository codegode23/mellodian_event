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
    <title>Bookings</title>
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
                        <h4>Bookings
                            
                        </h4>
                    </div>
                    <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Customer</th>
                                <th>Event price</th>
                                <th>Seat Type</th>
                                <th>Number of Tickets</th>
                                <th>Date Of Event</th>
                                <th>Booked On</th>
                                <th>Event Total</th>
                                <th>Actions</th>

                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM bookings";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0 )
                                {
                                    foreach($query_run as $book)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $book['book_id']; ?></td>
                                            <td><?= $book['book_event_name']; ?></td>
                                            <td><?= $book['book_user_name']; ?></td>
                                            <td> Ghc: <?= $book['book_event_price']; ?></td>
                                            <td><?= $book['book_seats_type']; ?></td>
                                            <td><?= $book['number_of_seats']; ?></td>
                                            <td><?= $book['event_date']; ?></td>
                                            <td><?= $book['booked_on']; ?></td>
                                            <td> Ghc: <?= $book['book_total']; ?></td>
                                           
                                            <td>
                                                <a href="edit_booking.php?id=<?= $book['book_id']  ?>" class="btn btn-success btn-sm">Edit</a>
                                                
                                                <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_event" value="<?= $book['book_id'];?>" class="btn btn-danger btn-sm">Delete</button>
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