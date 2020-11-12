<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) ) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Delete meal | Restaurant</title>
    
</head>
<body class="bg-light">

    <div class="container my-4">
        <div class='row pt-2 alert alert-secondary rounded-lg'>
            <div class='col-10 offset-1 text-center pb-4'>

                <?php 
                    require_once 'db_connect.php';
                    if ($_POST) {
                        $id = $_POST['id'];
                        $sql = "DELETE FROM meals WHERE meal_id = {$id}";
                            if($connect->query($sql) === TRUE) {
                            echo "<h3>Successfully deleted!!</h3><a class='btn btn-primary' href='../index.php'>Back to home</a>";
                        } else {
                            echo "<h3>Error updating record: ". $connect->error ."</h3>";
                        }

                        $connect->close();
                    }
                ?>

            </div>
        </div>
    </div >
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>