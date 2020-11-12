<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // it will never let you open index(login) page if session is set
    if ( isset($_SESSION['user' ])!="" ) {
        header("Location: home.php");
        exit;
    }

    $error = false;
   
    if( isset($_POST['btn-login']) ) {
   
        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        // prevent sql injections / clear user invalid inputs
    
        if(empty($email)){
            $error = true;
            $emailError = "Please enter your email address.";
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }
    
        if (empty($pass)){
            $error = true;
            $passError = "Please enter your password." ;
        }
    
        // if there's no error, continue to login
        if (!$error) {
            $password = hash( 'sha256', $pass); // password hashing
            $res=mysqli_query($connect, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

            if( $count == 1 && $row['userPass' ]==$password ) {
                $_SESSION['user'] = $row['userId'];
                header( "Location: home.php");
            } else {
                $errMSG = "Incorrect Credentials, Try again..." ;
            }
    
    }
   
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <title>Restaurant</title>
    </head>
    <body class="bg-light">

    <?php include('navbar.php'); ?>

    <div class="row">
        <div class="col-12">
            <img src="assets/header.jpg" alt="Good food at Restaurante Unicórnio Tesão" class="img-fluid shadow">
        </div>
    </div>

    <div class="container">
        <h2 class="mt-5">Unicórnio Tesão Meal Database</h2>
            <div class="row mb-5 alert alert-primary pb-4 rounded-lg">
            <div class="col-12">
                <h2 class="my-4">Login</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                    <?php
                        if ( isset($errMSG) ) {
                        echo  $errMSG;
                    ?>
                    <?php } ?>
                    <div class="row my-2">
                        <div class="col-4">
                            Email Address
                        </div>
                        <div class="col-8">
                            <input type="email" name="email" class="form-control" placeholder="Your email address" value="<?php echo $email; ?>"  maxlength="40" />
                            <span class="text-danger"><?php  echo $emailError; ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">
                            Password
                        </div>
                        <div class="col-8">
                            <input type="password" name="pass"  class="form-control" placeholder="Your password" maxlength="15"  />
                            <span class="text-danger"><?php  echo $passError; ?></span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4">
                            <button class="btn btn-primary m-2" type="submit" name="btn-login">Login</button>
                            <a class="btn btn-secondary m-2" href="register.php">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php include('footer.php'); ?>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>





