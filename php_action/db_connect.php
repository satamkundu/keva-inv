<?php 	

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "keva_db";
// $con = mysqli_connect("localhost", "root", "Kustav9609..", "keva_db");
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>