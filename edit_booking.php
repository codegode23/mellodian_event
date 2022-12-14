
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
<title>Edit Booking</title>
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
                    <h4>Edit Event <a href="events.php" class="btn btn-danger float-end">BACK</a> </h4>
                </div>
                <div class="card-body">

                    <?php
                    
                        if(isset($_GET['id']))
                        {
                            $booking_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM bookings WHERE book_id='$booking_id'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $booking = mysqli_fetch_array($query_run);
                                ?>
                                
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="book_id" value="<?= $booking_id?>" >

                            <div class="mb-3">
                                <label >Event</label>
                                <input type="text" name="event_name" value="<?= $booking['book_event_name'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label >Customer</label>
                                <input type="text" name="customer_name" value="<?= $booking['book_user_name'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Event Price</label>
                                <input type="number" name="event_price" value="<?= $booking['book_event_price'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Type of seat</label>
                                <input type="text" name="seat_type" value="<?= $booking['book_seats_type'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Number of Tickects</label>
                                <input type="number"  min="1" max="8" name="num_of_tickets" value="<?= $booking['number_of_seats'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Date Of Event</label>
                                <input type="text" name="event_date" value="<?= $booking['event_date'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Booked On</label>
                                <input type="text" name="date" value="<?= $booking['booked_on'];?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Event Total</label>
                                <p><?= $booking['book_total'];?></p> 
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_booking" class="btn btn-primary" >Update Event</button>
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