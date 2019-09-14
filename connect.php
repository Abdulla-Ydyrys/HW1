<!--Name and Surname: Abdulla Ydyrys;
	Date end: 14.09.2019;
	Email: 170103125@stu.sdu.edu.kz;
	Description: Connect to a database
-->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

//Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
//Check connection
if($conn === false){
    die("Connection failed: " . mysqli_connect_error());
}
?>