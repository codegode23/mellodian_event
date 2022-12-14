<?php
include 'config.php';

session_start();

$user_id =   $_SESSION['user_id'];
$user_name =   $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:index.login.php');
}

    
    if(isset($_POST['delete_customer']))

    {
        $customer_id = mysqli_real_escape_string($conn, $_POST['delete_customer']);

        $query = "DELETE FROM customers WHERE id='$customer_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
         {
            $_SESSION['message'] = "Customer deleted Successfully";
            header("Location: admin_page.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Customer not deleted";
            header("Location: admin_page.php");
            exit(0);
         }

    }

    if(isset($_POST['update_customer']))

    {
        $customer_id = mysqli_real_escape_string($conn, $_POST['id']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $query = "UPDATE customers
        SET first_name='$fname', last_name='$lname', username='$username', dob='$dob', email='$email', telephone='$tel', address='$address'
         WHERE id='$customer_id' ";

         $query_run = mysqli_query($conn, $query);

         if($query_run)
         {
            $update_image = $_FILES['image']['name'];
            $update_image_tmp_name = $_FILES['image']['tmp_name'];
            $update_image_size = $_FILES['image']['size'];
            $update_folder = 'images/'.$update_image;
                    $update_old_image = $_POST['update_old_image'];

            if(!empty($update_image)){
                if($update_image_size > 2000000) {
                    $message[] = 'image file size is too large';
                }else{
                    mysqli_query($conn, "UPDATE `customers` SET image = '$update_image' WHERE id = '$customer_id'") 
                    or die('query failed');

                    move_uploaded_file($update_image_tmp_name, $update_folder);
                    unlink('images/'.$update_old_image);

                }
            }

            $_SESSION['message'] = "Customer updated successfully";
            header("Location: admin_page.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Customer not updated";
            header("Location: admin_page.php");
            exit(0);
         }

         


    }


    if(isset($_POST['save_customer'])){
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $address = mysqli_real_escape_string($conn, 'info:'. $_POST['house_num'].', '. $_POST['street_name'].'
        , '. $_POST['post_code']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/'.$image;
       
    
    
       $select_users = mysqli_query($conn, "SELECT * FROM `customers` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
       if(mysqli_num_rows($select_users) > 0) {
           $message[] = 'user already exists!';
       }

       else{
        $add_user = mysqli_query($conn, "INSERT INTO `customers` (first_name, last_name, username, password, dob, email, telephone, address, image) 
        VALUES ('$fname', '$lname', '$username', '$pass', '$dob', '$email', '$tel', '$address', '$image')")
        or die(mysqli_error($conn));
        // $message[] = 'registered successfully';
        // header('location: login.php');
        if($add_user){
            if($image_size > 200000){
                $message[] = 'image size is too large';
            }
            else{
                 move_uploaded_file($image_tmp_name, $image_folder);
                 header('location: admin_page.php');
            }
           
        }
        else{
            $message[] = 'user could not be added successfully!';
        }
       }
       
    }
    
       
    

    
    if(isset($_POST['delete_event']))

    {
        $booking_id = mysqli_real_escape_string($conn, $_POST['delete_event']);

        $query = "DELETE FROM bookings WHERE book_id='$booking_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
         {
            $_SESSION['message'] = "Event deleted Successfully";
            header("Location: events.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Event not deleted";
            header("Location: events.php");
            exit(0);
         }

    }


    
    if(isset($_POST['update_booking']))

    {
        $event_id = mysqli_real_escape_string($conn, $_POST['book_id']);
        $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
        $event_price = mysqli_real_escape_string($conn, $_POST['event_price']);
        $seat_type = mysqli_real_escape_string($conn, $_POST['seat_type']);
        $num_of_tickets = mysqli_real_escape_string($conn, $_POST['num_of_tickets']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $date_event = mysqli_real_escape_string($conn, $_POST['event_date']);
        $total = $event_price * $num_of_tickets;

        $query = "UPDATE bookings 
        SET book_event_name='$event_name', book_user_name='$customer_name', book_event_price='$event_price', book_seats_type='$seat_type',
         number_of_seats='$num_of_tickets', event_date='$date_event', booked_on='$date', book_total='$total'
         WHERE book_id='$event_id' ";

         $query_run = mysqli_query($conn, $query);

         if($query_run)
         {
            $_SESSION['message'] = "Event Updated Successfully";
            header("Location: events.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Event not Updated";
            header("Location: events.php");
            exit(0);
         }

    }


    //Add event

    if(isset($_POST['save_event'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/'.$image;
    
       $select_event = mysqli_query($conn, "SELECT * FROM `events` WHERE event_name = '$name'") or die('query failed');
    
        if(mysqli_num_rows($select_event) > 0) {
            $message[] = 'event already exists!';
        }

            else{
                $add_event = mysqli_query($conn, "INSERT INTO `events` (event_name, event_price, event_date, image) 
                VALUES ('$name', '$price', '$date', '$image')")
                or die(mysqli_error($conn));
                // $_SESSION['message'] = "Event added Successfully";
                // header("Location: event.php");
                // exit(0);
            
            }

            if($add_event){
                if($image_size > 200000){
                    $message[] = 'image size is too large';
                }
                else{
                     move_uploaded_file($image_tmp_name, $image_folder);
                     header('location: event.php');
                }
               
            }

            
        else{
            $message[] = 'event could not be added successfully!';
        }
       
       
    }
    

    //Update event

    
    if(isset($_POST['update_event']))

    {
        $event_id = mysqli_real_escape_string($conn, $_POST['id']);
        $event_name = mysqli_real_escape_string($conn, $_POST['name']);
        $event_price = mysqli_real_escape_string($conn, $_POST['price']);
        $date_event = mysqli_real_escape_string($conn, $_POST['date']);
       

        $query = "UPDATE events
        SET event_name='$event_name', event_price='$event_price', event_date='$date_event'
         WHERE id='$event_id' ";

         $query_run = mysqli_query($conn, $query);

         if($query_run)
         {
            $update_image = $_FILES['image']['name'];
            $update_image_tmp_name = $_FILES['image']['tmp_name'];
            $update_image_size = $_FILES['image']['size'];
            $update_folder = 'images/'.$update_image;
                    $update_old_image = $_POST['update_old_image'];

            if(!empty($update_image)){
                if($update_image_size > 2000000) {
                    $message[] = 'image file size is too large';
                }else{
                    mysqli_query($conn, "UPDATE `events` SET image = '$update_image' WHERE id = '$event_id'") 
                    or die('query failed');

                    move_uploaded_file($update_image_tmp_name, $update_folder);
                    unlink('images/'.$update_old_image);

                }
            }

            $_SESSION['message'] = "Event updated successfully";
            header("Location: event.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Event not updated";
            header("Location: event.php");
            exit(0);
         }

         

    }

    //Delete an event

    
    if(isset($_POST['delete_an_event']))

    {
        $event_id = mysqli_real_escape_string($conn, $_POST['delete_an_event']);

        $query = "DELETE FROM events WHERE id='$event_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
         {
            $_SESSION['message'] = "Event deleted Successfully";
            header("Location: event.php");
            exit(0);
         }
         else
         {
            $_SESSION['message'] = "Event not deleted";
            header("Location: event.php");
            exit(0);
         }

    }
    
?>