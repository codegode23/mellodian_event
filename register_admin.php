<?php

include 'config.php';

if(isset($_POST['submit'])){

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['password']);   

   $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select_admin) > 0) {
        $message[] = 'user already exists!';
    }
    else{
            if($pass != $cpass) {
                $message[] = 'confirm password not matched';
        }
        else{
            $add_admin = mysqli_query($conn, "INSERT INTO `admin` (first_name, last_name, username, email, password) 
            VALUES ('$fname', '$lname', '$username', '$email', '$cpass')")
            or die(mysqli_error($conn));
            $message[] = 'registered successfully';
            header('location: adminlogin.php');
        
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

                <h3>Admin register</h3>

                <input type="text" name="fname" placeholder="enter your first name" required class="box">

                <input type="text" name="lname" placeholder="enter your last name" required class="box">
                
                <input type="text" name="username" placeholder="enter your username" required class="box">
                
                <input type="text" name="email" placeholder="enter your email" required class="box">

                <input type="password" name="password" placeholder="enter your password" required class="box">

                <input type="password" name="cpassword" placeholder="confirm your password" required class="box">

                <input type="submit" name="submit" value="register now" class="btns">

                <p>already have an account? <a href="adminlogin.php">login now</a></p>

            </form>

        </div>

</body>
</html>