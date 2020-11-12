<?php
    require_once 'actions/db_connect.php';
    if ( isset($_SESSION['user' ]) =="" ) {
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
        <title>Edit meal | Restaurant</title>
        
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class='row pt-2 alert alert-success rounded-lg'>
                <div class='col-10 offset-1 text-center'>

                    <?php 
                        require_once 'db_connect.php';

                        if ($_POST) {
                            $name = $_POST['formname'];
                            $image = $_POST['formimage'];
                            $ingredients = $_POST[ 'formingredients'];
                            $allergens = $_POST[ 'formallergens'];
                            $price = intval($_POST[ 'formprice']);

                            $id = $_POST['formid'];

                            $sql = "UPDATE meals SET name = '$name', image = '$image', price = '$price', ingredients = '$ingredients', allergens = '$allergens' WHERE meal_id = {$id}" ;
                            if($connect->query($sql) === TRUE) {
                                echo "<h3>Meal '$name' was successfully updated</h3><a class='btn btn-primary m-2' href='../update.php?id=" .$id."'>Edit meal</a><a class='btn btn-secondary m-2' href='../index.php'>Back to home</a>";
                            } else {
                                    echo "Error while updating record : ". $connect->error;
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