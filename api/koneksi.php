<?php
// $servername = "localhost";
// $username = "u151422786_mktm";
// $password = "susumaktam21";
// $dbname = "u151422786_mktm";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maktam";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>