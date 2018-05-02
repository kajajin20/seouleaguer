<?php
header("Content-Type: application/json;charset=utf-8");
include_once '../common/DBcon.php';

$id = $_POST['id'];
$password = md5($_POST['password']);

$query = "select * from user_table where id = '".$id."' and password = '".$password."' ";

$result = mysql_query($query, $conn);
$rslt = mysql_fetch_array($result);
 
if($id == $rslt['id']){
	mysql_close($conn); 
	exit('{"msg":"success"}');
	
}else{
	exit('{"msg":"fail"}');
}


?>