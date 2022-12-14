
<?php

include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:index.php');
}


if(isset($message)){
    foreach($message as $message){
        echo '
        
        <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Booked</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="logs">
<p>Username :  <?php echo $_SESSION['user_name']; ?>  </p>
<p><a href="logout.php">logout</a></p>
<p><a href="home.php">Home</a></p>
</div>

<h1>Events Booked</h1>

<?php

$select_booking = mysqli_query($conn, "SELECT * FROM `bookings` WHERE book_user_id='$user_id'") 
or die('query failed');

if(mysqli_num_rows($select_booking) > 0){
    while($fetch_booking = mysqli_fetch_assoc($select_booking)){
?>


<section class="card">

    

        <h2><?php echo $fetch_booking['book_event_name']; ?> </h2>
        <h2>Price: $ <?php echo $fetch_booking['book_event_price']; ?></h2>
        <h2>Seat Type: <?php echo $fetch_booking['book_seats_type']; ?></h2>
        <h2>Number of Tickets: <?php echo $fetch_booking['number_of_seats']; ?></h2>
        <h2>Event Date: <?php echo $fetch_booking['event_date']; ?></h2>
        <h2>Event Booked On: <?php echo $fetch_booking['booked_on']; ?></h2>
        <h2>Total Price for Event: $<?php echo $fetch_booking['book_total']; ?></h2>


    

</section>

<?php
}
}else{
echo   '<p class="empty"> No events added yet! </p>';
}

?>

    
</body>
</html>