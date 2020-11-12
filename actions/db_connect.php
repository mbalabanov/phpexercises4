<?php 
    // this will avoid mysql_connect() deprecation error.
    error_reporting( ~E_DEPRECATED & ~E_NOTICE );

    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restaurant";

    $connect = mysqli_connect($localhost, $username, $password, $dbname);

    // check connection
    if($connect->connect_error) {
        die("connection failed: " . $connect->connect_error);
    } else {
        // echo "<h4>Successfully Connected</h4>";
    }
?>