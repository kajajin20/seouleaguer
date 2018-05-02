<?php
header("Content-Type: application/json;charset=utf-8");
include_once '../common/DBcon.php';

$id = $_POST['id'];
$name = $_POST['name'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$age = $_POST['age'];
$sex = $_POST['sex'];

$query = "select * from user_table where id = '".$id."' ";
$result = mysql_query($query, $conn);
$rslt = mysql_fetch_array($result);

if($rslt['id'] == $id){
	mysql_close($conn); 
	exit('{"msg":"id_chk"}');
};


$query2 = "insert into user_table (id,name,password,email,age,sex) values('".$id."','".$name."','".$password."','".$email."',".$age.",'".$sex."') ";
 
mysql_query($query2, $conn);
mysql_close($conn); 
exit('{"msg":"success"}');
//header("Location: /test/index.php");
?>