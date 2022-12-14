<?php

include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];


if(!isset($user_id)){
    header('location:index.php');
}


if(isset($_POST['book'])){

    $event_name = $_POST['event_name'];
    $event_price = $_POST['event_price'];
    $seat_type = $_POST['seat_type'];
    $seat_num = $_POST['seat_num'];
    $booked_on = date('d-M-Y');
    $book_total = $event_price * $seat_num;
    $book_event_date = $_POST['event_date'];

    $check_book_numbers = mysqli_query($conn, "SELECT * FROM `bookings` WHERE book_event_name='$event_name' AND book_user_id='$user_id'") 
    or die(mysqli_error($conn));

    if(mysqli_num_rows($check_book_numbers) > 0) {
        $message[] = 'already booked';
    }else{
        mysqli_query($conn, 
        "INSERT INTO `bookings` (book_user_id, book_user_name, book_event_name, book_event_price, book_seats_type, number_of_seats, event_date, booked_on, book_total)
         VALUES('$user_id', '$user_name', '$event_name', '$event_price', '$seat_type', '$seat_num', '$book_event_date', '$booked_on', '$book_total')")
        or die(mysqli_error($conn));

        $message[] = 'event booked';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mellodian Community Park Authority</title>
    <link rel="stylesheet" href="style.css">

      
<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
   
</head>
<body>
    <?php
    $select_customer = mysqli_query($conn, "SELECT * FROM `customers` WHERE id = '$user_id'")
    or die('query failed');
?>


<?php

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

    <div class="logs">
        <div class="logs-container">
            <p><?php echo $_SESSION['user_name']; ?></p>
            <p><a href="logout.php">logout</a></p>
            <p><a href="bookings.php">Events booked</a></p>
        </div>
    </div>


    <!---Booking section starts-->

    <section class="booking" id="booking">

        <div class="heading">
            <!-- <h1>Mellodian Community Park Authority </h1> -->
            <h1>Book an event </h1>
            <p>Go through our series of fun festival events, reserve your seats and book your tickets here</p>
        </div>


        <div class="events">
            <?php

                $select_event = mysqli_query($conn, "SELECT * FROM `events`") 
                or die('query failed');

                if(mysqli_num_rows($select_event) > 0){
                    while($fetch_event = mysqli_fetch_assoc($select_event)){
            ?>

                <form  method="post" class="boxe">

                    <div class="image">
                        <img src="images/<?php echo $fetch_event['image']; ?>" alt="">
                    </div>
 
                    <div class="info">
                        <h3><?php echo $fetch_event['event_name']; ?> </h3>
                        <h4>Price: Ghc <?php echo $fetch_event['event_price']; ?></h4>
                        <h4>Date of Event: <?php echo $fetch_event['event_date']; ?></h4>
    
                        <p>Number of tickets:  <input type="number" min="1" max="8" name="seat_num" value="1"></p> 
                        <select name="seat_type">
                            <option value="With tables">Seats With Tables</option>
                            <option value="Without tables">Seats Without Tables</option>
                        </select>
                        <!-- <input type="hidden" name="event_name" value=" <?php echo $fetch_event['event_name'];  ?> ">
                        <input type="hidden" name="event_price" value=" <?php echo $fetch_event['event_price']; ?>">
                        <input type="hidden" name="event_date" value=" <?php echo $fetch_event['event_date']; ?>">
                        -->
                        <input type="submit" value="Book" class="btn" name="book">
                    </div>
                  
                
             
             </form>

            <?php
                    }
                    }else{
                    echo  '<p class="empty"> No events added yet! </p>';
                    }

                ?>


        </div>

               
       

     
    </section>
       


     

   

</body>
</html>
