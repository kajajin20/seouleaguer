<?php
class facebook extends Controller
{
	public function index()
	{
		require 'application/views/facebook/index.php';
	}

	public function timeline(){
		require 'application/views/facebook/timeline.php';
	}
	public function login_action(){
		$facebook_model = $this->loadModel('FacebookModel');
		$id = $_POST['id'];
		$password = md5($_POST['password']);
		$login_id = $facebook_model->getLoginId($id, $password);
		$array = (array)$login_id;
		if(!empty($array['id'])){
			if($id == $array['id']){
				session_start();
				$_SESSION['id'] = $id;
				$_SESSION['name'] = $array['name'];
				exit('{"msg":"success"}');
				
			}
		}else{
				exit('{"msg":"fail"}');
		}
		
	}
	public function logout_action(){
		session_start();
		$_SESSION['id'] = "";
		$_SESSION['name'] = "";
		session_destroy();
		exit('{"msg":"success"}');
	}
	public function timeline_insert(){
		$facebook_model = $this->loadModel('FacebookModel');
		
		$name = $_POST['name'];
		$memo = $_POST['memo'];
		
		// 설정
		$uploads_dir = '/var/www/html/public/img';
		$allowed_ext = array('jpg','jpeg','png','gif');

		// 변수 정리
		$error = $_FILES['myfile']['error'];
		$filename = $_FILES['myfile']['name'];
		$ext = array_pop(explode('.', $filename));
		 
		// 오류 확인
		if( $error != UPLOAD_ERR_OK ) {
			switch( $error ) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					echo "파일이 너무 큽니다. ($error)";
					break;
					exit;
				case UPLOAD_ERR_NO_FILE:
					$filename = "";
					
				default:
					$filename = "";
					
			}
			
		}
		if($filename !=''){
			// 확장자 확인
			if( !in_array($ext, $allowed_ext) ) {
				echo "허용되지 않는 확장자입니다.";
				exit;
			} 
			// 파일 이동
			move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$filename");
		}

		$facebook_model->timeline_insert($name, $memo, $filename);


		echo"<script>location.href='/facebook/timeline'</script>";
	}
	public function join_action()
	{
		header("Content-Type: application/json;charset=utf-8");
		$facebook_model = $this->loadModel('FacebookModel');
		$id = $_POST['id'];
		$name = $_POST['name'];
		$password = md5($_POST['password']);
		$sex = $_POST['sex'];
		
		$login_id = $facebook_model->login_check($id);
		$array = (array)$login_id;
		if(!empty($array['id'])){
			if($id == $array['id']){
				exit('{"msg":"id_chk"}');
			};
		}
		
		
		$facebook_model->insertMember($id, $name, $password, $sex);

		exit('{"msg":"success"}');
	}

}
