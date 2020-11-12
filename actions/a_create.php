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
    <title>Add meal | Restaurant</title>
    
</head>
<body class="bg-light">

    <div class="container my-4">
        <div class='row pt-2 alert alert-primary rounded-lg'>
            <div class='col-10 offset-1 text-center'>

                <?php 
                    require_once 'db_connect.php';

                    if ($_POST) {
                    $name = $_POST['formname'];
                    $image = $_POST['formimage'];
                    $ingredients = $_POST[ 'formingredients'];
                    $allergens = $_POST[ 'formallergens'];
                    $price = intval($_POST[ 'formprice']);

                    $sql = "INSERT INTO meals (name, image, price, ingredients, allergens) VALUES ('$name', '$image', '$price', '$ingredients', '$allergens')";
                        if($connect->query($sql) === TRUE) {
                        echo "
                            <h3>New meal '$name' successfully added to database</h3>
                            <a class='btn btn-primary m-2' href='../create.php'>New meal</a><a class='btn btn-secondary m-2' href='../index.php'>Back to home</a>
                            ";
                    } else  {
                        echo "
                        <div class='alert alert-danger pt-2 text-center' role='alert'>
                            <h3>Error " . $sql ." ". $connect->connect_error ."</h3>
                        </div>
                        ";
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