<?php
$servername = "localhost";
$username = "root";
$password = "tj0nfflrj!$";
$mysql_db = "member";

// Create connection
$conn = mysql_connect($servername, $username, $password);
$db = mysql_select_db($mysql_db, $conn);
mysql_set_charset("utf8", $conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*
echo "Connected successfully";
if($db)
 echo "db 연결성공";
else
 echo "db 연결 실패";
 */
?>