<?php 
    ob_start();
    session_start();

    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user' ]) ) {
        header("Location: index.php");
        exit;
    }

    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM meals WHERE meal_id = {$id}" ;
        $result = $connect->query($sql);
        $data = $result->fetch_assoc();
        $connect->close();
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

    <title>Edit meal | Restaurant</title>

</head>
<body class="bg-light">

<?php include('navbar.php'); ?>

<div class="container my-4">
    <div class="row mt-3 pt-2 alert alert-primary rounded-lg">
        <div class="col-10 offset-1">
            <h3 class="mt-2">Edit Meal</h3>
            <form action="actions/a_update.php" method="post">
                <table class="table">
                    <div class="row my-2">
                        <div class="col-4">Meal ID (read only)</div>
                        <div class="col-8"><input class="form-control" type="text" name="formid" value="<?php echo $data['meal_id'] ?>"  readonly/></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">Meal Name</div>
                        <div class="col-8"><input class="form-control" type="text" name="formname"  placeholder="Meal Name"  value="<?php echo $data['name'] ?>" /></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">Image URL</div>
                        <div class="col-8"><input class="form-control" type="text" name= "formimage" placeholder="Image URL" value="<?php echo $data['image'] ?>" /></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">Ingredients</div>
                        <div class="col-8"><textarea rows="4" cols="50" class="form-control" name="formingredients" placeholder="Ingredients"><?php echo $data['ingredients'] ?></textarea></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">Allergens</div>
                        <div class="col-8"><input class="form-control" type="text" name="formallergens" placeholder="Allergens"  value="<?php echo $data['allergens'] ?>" /></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">Price</div>
                        <div class="col-8"><input class="form-control" type="number" name="formprice" placeholder="0" value="<?php echo $data['price'] ?>" /></div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4"><button class="btn btn-primary m-2" type ="submit">Update meal</button><a class="btn btn-secondary m-2" href="index.php">Back to home</a></div>
                        <div class="col-8">&nbsp;</div>
                    </div>
                </table>
            </form>
        </div>
    </div>
</div >

<?php include('footer.php'); ?>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>