<?php
##database connection##

$mysql_hostname = "localhost";
$mysql_username = "root";
$mysql_password = "root";
$dbname = "final_project";

// Create connection
$connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


### Capture data from HTML input fields ###

$firstname = $_POST["signup-firstname"];
$lastname = $_POST["signup-lastname"];
$email = $_POST["signup-email"];
$password = $_POST["signup-password"];

##Create the SQL query##

$insert_sql_query = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

if ($connect->query($insert_sql_query ) === TRUE) {
  echo "Your profile has been created successfully! We will contact you to procced with the donation!";
} else {
  echo "Error: " . $insert_sql_query  . "<br>" . $connect->error;
}

$connect->close();

?>