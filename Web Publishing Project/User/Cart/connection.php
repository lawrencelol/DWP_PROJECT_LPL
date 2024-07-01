<?php
$dbhost = 'localhost';
$dbuser = 'root';  // Replace with your database username
$dbpass = '';      // Replace with your database password
$dbname = 'dwp_project'; // Replace with your database name

$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
