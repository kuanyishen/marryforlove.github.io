<?php

#database connection

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

$login_email = $_POST["email"];
$login_password = $_POST["password"];

######## create sql query #######
$sql_query = "SELECT firstname, lastname, password, email FROM users WHERE email='$login_email'";

######## Run sql query #######
$result = $connect->query($sql_query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["password"] == $login_password) {
        	echo "<br> Welcome back ". $row["firstname"]. " ". $row["lastname"] . "<br>";

        	if ($row["email"] == 'admin@email.com') {
        		$sql_query_all_data = "SELECT * FROM users";
        		$all_result = $connect->query($sql_query_all_data);
        		echo "<br>LIST OF ALL REGISTERED USERS";

        		while ($cur_row = $all_result->fetch_assoc()) {
        			echo "<br> Name: " . $cur_row['firstname'] . " " . $cur_row['lastname'] . ", Email: " . $cur_row['email'];
        		}

        	}

        }
        else {
        	echo "Invalid Password";
        }
    }
} else {
    echo "Email ID does not exist";
}
$connect->close();
?>
