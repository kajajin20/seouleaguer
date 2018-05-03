<?php
class join extends Controller
{
	public function index()
	{
		$this->intro();
	}
	public function intro()
	{
		require 'application/views/_templates/header.php';
		require 'application/views/join/index.php';
		require 'application/views/_templates/footer.php';
	}
	public function join_action()
	{
		header("Content-Type: application/json;charset=utf-8");
		$join_model = $this->loadModel('JoinModel');
		$id = $_POST['id'];
		$name = $_POST['name'];
		$password = md5($_POST['password']);
		$email = $_POST['email'];
		$age = $_POST['age'];
		$sex = $_POST['sex'];
		
		$login_id = $join_model->login_check($id);
		$array = (array)$login_id;
		
		if($id == $array['id']){
			exit('{"msg":"id_chk"}');
		};
		
		$login_id = $join_model->insertMember($id, $name, $password, $email, $age, $sex);
		exit('{"msg":"success"}');
	}


}
