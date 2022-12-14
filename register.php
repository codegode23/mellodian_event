<?php

include 'config.php';

if(isset($_POST['submit'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['password']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $address = mysqli_real_escape_string($conn, 'info:'. $_POST['house_num'].', '. $_POST['street_name'].'
    , ' . $_POST['post_code']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/'.$image;
   


   $select_users = mysqli_query($conn, "SELECT * FROM `customers` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0) {
       $message[] = 'user already exists!';
   }
   else{
       if($pass != $cpass) {
        $message[] = 'confirm password not matched';
   }
   else{
    $add_user = mysqli_query($conn, "INSERT INTO `customers` (first_name, last_name, username, password, dob, email, telephone, address, image) 
    VALUES ('$fname', '$lname', '$username', '$cpass', '$dob', '$email', '$tel', '$address', '$image')")
    or die(mysqli_error($conn));
    // $message[] = 'registered successfully';
    // header('location: login.php');
    if($add_user){
        if($image_size > 200000){
            $message[] = 'image size is too large';
        }
        else{
             move_uploaded_file($image_tmp_name, $image_folder);
             header('location: index.php');
        }
       
    }
    else{
        $message[] = 'user could not be added successfully!';
    }
   }
   
}

   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https:///cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>


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

        <div class="form-container">

            <form action="" method="post" enctype="multipart/form-data">

                <h3>register now</h3>

                <input type="text" name="fname" placeholder="enter your first name" required class="box">

                <input type="text" name="lname" placeholder="enter your last name" required class="box">
                
                <input type="text" name="username" placeholder="enter your username" required class="box">

                <input type="password" name="password" placeholder="enter your password" required class="box">

                <input type="password" name="cpassword" placeholder="confirm your password" required class="box">

                <input type="date" name="dob" placeholder="enter your date of birth" required class="box">

                <input type="text" name="email" placeholder="enter your email" required class="box">

                <input type="number" name="tel" placeholder="enter your phone number" required class="box">

                <input type="text" name="house_num" placeholder="enter your house number" required class="box">

                <input type="text" name="street_name" placeholder="enter your street name" required class="box">

                <input type="text" name="post_code" placeholder="enter your post code" required class="box">

                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png">

                <input type="submit" name="submit" value="register now" class="btns">

                <p>already have an account? <a href="index.php">login now</a></p>

            </form>

        </div>

</body>
</html>