<?php
    ob_start();
    session_start();

    // if session is not set this will redirect to login page
    if( isset($_SESSION['user' ]) ) {
        header("Location: index.php");
        exit;
    }

    if( isset($_SESSION['user'])!="" ){
        header("Location: home.php" ); // redirects to home.php
    }
    include_once 'actions/db_connect.php';
    $error = false;
    if ( isset($_POST['btn-signup']) ) {
    
    // sanitize user input to prevent sql injection
    $name = trim($_POST['name']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name);

    // strip_tags — strips HTML and PHP tags from a string
    $name = htmlspecialchars($name);
    
    // htmlspecialchars converts special characters to HTML entities
    $email = trim($_POST[ 'email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $userImage = trim($_POST[ 'userimage']);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if (empty($name)) {
        $error = true ;
        $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true ;
        $nameError = "Name must contain alphabets and space.";
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Please enter valid email address." ;
    } else {
        // checks whether the email exists or not
        $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)){
        $error = true;
        $passError = "Please enter password.";
    } else if(strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters." ;
    }

    // password hashing for security
    $password = hash('sha256' , $pass);
    // if there's no error, continue to signup
    if( !$error ) {
        $query = "INSERT INTO users(userName,userEmail,userPass,userImage) VALUES('$name','$email','$password','$userImage')";
        $res = mysqli_query($connect, $query);

        if ($res) {
        $errTyp = "warning";
        $errMSG = "Successfully registered, please login.";
        unset($name);
        unset($email);
        unset($pass);
    } else  {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later..." ;
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

        <div class="container my-5">
            <div class="row">
                <div class="col-8 offset-2 pt-2 alert alert-primary rounded-lg">
                    <h2 class="my-4 text-center">Register</h2>
                    <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
                        
                        <?php
                            if ( isset($errMSG) ) {
                        ?>

                        <div class="alert alert-<?php echo $errTyp ?>" >
                            <?php echo $errMSG; ?>
                        </div>

                        <?php
                            }
                        ?>
                        
                        <div class="row my-2">
                            <div class="col-4 text-right">
                                Name
                            </div>
                            <div class="col-8">
                                <input type ="text"  name="name"  class="form-control"  placeholder="Your name" maxlength="50" value="<?php echo $name ?>"  />
                                <span class="text-danger"> <?php echo $nameError; ?> </span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4 text-right">
                                Email Address
                            </div>
                            <div class="col-8">
                                <input type="email" name="email" class="form-control" placeholder="Your email address" maxlength="40" value ="<?php echo $email ?>"  />
                                <span  class="text-danger"> <?php echo $emailError; ?> </span> 
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4 text-right">
                                User Image URL<br><sup>(optional)</sup>
                            </div>
                            <div class="col-8">
                                <input type="text" name="userimage" class="form-control" placeholder="The URL of your image" value ="<?php echo $userimage ?>"  />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4 text-right">
                                Password
                            </div>
                            <div class="col-8">
                                <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15"  />
                                <span class="text-danger"> <?php echo $passError; ?> </span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4">
                            </div>
                            <div class="col-8 text-center">
                                <button type="submit" class="btn btn-primary m-2" name="btn-signup">Register</button>
                                <a class="btn btn-secondary m-2" href="index.php">Back to login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>