<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

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
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>

<section class="dashboard">

    
    
<?php
   
   $select_cart_number = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'")
   or die('query failed');

?>


    <div class="logs">
        <div class="logs-container">
            <p><a href="admin_page.php">Customers</a></p>
            <p><a href="event.php">Events</a></p>
            <p><a href="events.php">Bookings</a></p>
            <p><a href="logout.php">Logout</a></p>
        </div>
       
    </div>


    <h2 class="title">Dashboard</h2>

    <div class="box-container">
        <div class="box">

        <?php

        $select_customers = mysqli_query($conn, "SELECT * FROM `customers` ") 
        or die('query failed');

        $number_of_customers = mysqli_num_rows($select_customers);

        ?>

        <h3> <?php echo $number_of_customers; ?> </h3>
        <p>Customers</p>
    </div>

    <div class="box">
        <?php

        $select_events = mysqli_query($conn, "SELECT * FROM `events`") 
        or die('query failed');

        $number_of_events = mysqli_num_rows($select_events);
        
        ?>

        <h3> <?php echo $number_of_events; ?> </h3>
        <p>Events</p>
    </div>

    <div class="box">
        <?php

        $select_bookings = mysqli_query($conn, "SELECT * FROM `bookings`") 
        or die('query failed');

        $number_of_bookings = mysqli_num_rows($select_bookings);
        
        
        ?>

        <h3> <?php echo $number_of_bookings; ?> </h3>
        <p>Total bookings</p>
    </div>

    </div>


</section>

</body>
</html>