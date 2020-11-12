<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

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
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Add meal | Restaurant</title>

</head>
<body class="bg-light">

<?php include('navbar.php'); ?>

<div class="container my-4">
    <div class="row mt-3 pt-2 alert alert-primary rounded-lg">
        <div class="col-10 offset-1">
            <h3 class="mt-2">Add Meal</h3>
            <form action="actions/a_create.php" method="post">
                <div class="row my-2">
                    <div class="col-md-4">Meal Name</div >
                    <div class="col-md-8"><input class="form-control" type="text" name="formname"  placeholder="Meal Name" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">Image URL</div>
                    <div class="col-md-8"><input class="form-control" type="text" name= "formimage" placeholder="Image URL" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">Ingredients</div>
                    <div class="col-md-8"><textarea rows="4" cols="50" class="form-control"  name="formingredients" placeholder="Ingredients" ></textarea></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">Allergens</div>
                    <div class="col-md-8"><input class="form-control" type="text" name="formallergens" placeholder="Allergens" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">Price</div>
                    <div class="col-md-8"><input class="form-control" type="number" name="formprice" placeholder="0" /></div>
                </div>
                <div class="row my-2">
                    <div class="col-md-12"><button class="btn btn-primary m-2" type ="submit">Insert meal</button><a class="btn btn-secondary m-2" href="index.php">Back to home</a></div>
                </div>
            </form>
        </div>
    </div>
</div >

<?php include('footer.php'); ?>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>