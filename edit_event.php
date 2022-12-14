
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
<title>Edit Event</title>
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
                    <h4>Edit Event <a href="event.php" class="btn btn-danger float-end">BACK</a> </h4>
                </div>
                <div class="card-body">

                    <?php
                    
                        if(isset($_GET['id']))
                        {
                            $event_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM events WHERE id='$event_id'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $event = mysqli_fetch_array($query_run);
                                ?>
                                
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="id" value="<?= $event_id?>" >

                                <div class="mb-3">
                                    <label for=" fName">First Name</label>
                                    <input type="text" name="name" value="<?= $event['event_name'];?>" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for=" lName">Last Name</label>
                                    <input type="text" name="price" value="<?= $event['event_price'];?>" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for=" uName">Username</label>
                                    <input type="date" name="date" value="<?= $event['event_date'];?>" class="form-control">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="images">Images</label>
                                    <input type="file"  name="image" accept="image/jpg, image/jpeg, image/png">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="update_event" class="btn btn-primary" >Update event</button>
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