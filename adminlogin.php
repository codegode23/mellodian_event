<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
   
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, ($_POST['password']));
    

   $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die(mysqli_error($conn));

   if(mysqli_num_rows($select_users) > 0) {
      $row = mysqli_fetch_assoc($select_users);

        $_SESSION['user_name'] = $row['username'] ;
        $_SESSION['user_email'] = $row['email'] ;
        $_SESSION['user_id'] = $row['id'] ;
        header('location:admin_home.php');
    
   }
   else{
    echo 'unsucessful';
   }

   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

<form action="" method="post">

<h3>Admin Login </h3>

<input type="text" name="email" placeholder="enter your email" required class="box">

<input type="password" name="password" placeholder="enter your password" required class="box">

<input type="submit" name="submit" value="login now" class="btns">

<p>don't have an account? <a href="register_admin.php">register now</a></p>

<p> <a href="index.php">Go back to user login</a></p>

</form>

</div>

</body>
</html>