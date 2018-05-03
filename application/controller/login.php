<?php
class login extends Controller
{
	public function index()
	{
		require 'application/views/_templates/header.php';
		require 'application/views/login/index.php';
		require 'application/views/_templates/footer.php';
	}
	public function login_action(){
		$login_model = $this->loadModel('LoginModel');
		$id = $_POST['id'];
		$password = md5($_POST['password']);
		$login_id = $login_model->getLoginId($id, $password);
		$array = (array)$login_id;

		if($id == $array['id']){
			session_start();
			$_SESSION['id'] = $id;
			exit('{"msg":"success"}');
			
		}else{
			exit('{"msg":"fail"}');
		}
	}
	public function logout_action(){
		session_start();
		$_SESSION['id'] = "";
		session_destroy();
		exit('{"msg":"success"}');
	}
}
