<?php
header("Content-Type: application/json;charset=utf-8");
include_once '../common/DBcon.php';

$id = $_POST['id'];
$name = $_POST['name'];
$password = crypt($_POST['password']);
$email = $_POST['email'];
$age = $_POST['age'];
$sex = $_POST['sex'];


$query = "insert into user_table (id,name,password,email,age,sex) values('".$id."','".$name."','".$password."','".$email."',".$age.",'".$sex."') ";

echo $query; 
mysql_query($query, $conn);

 
//header("Location: /test/index.php");
?>