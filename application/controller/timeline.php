<?php
class timeline extends Controller
{
	public function index()
	{
		require 'application/views/_templates/header.php';
		require 'application/views/timeline/index.php';
		require 'application/views/_templates/footer.php';
	}
	public function timeline_list(){
		$timeline_model = $this->loadModel('TimelineModel');
		$start_cnt = $_GET['start_cnt'];
		$end_cnt = $_GET['end_cnt'];
		$data = $timeline_model->timeline_select($start_cnt, $end_cnt);
		$result = json_decode(json_encode($data),TRUE);
		$result_cnt = count($result);
		

		$content = "";
		
		for($i=0; $i < $result_cnt; $i++){
			if($i == 0){
				$content .= " <li class='work'>
								<input class='radio' id='work".$i."' name='works' type='radio' checked>
								<div class='relative'>
									<label for='work".$i."'>".$result[$i]['name']."</label>
									<span class='date'>".$result[$i]['regdate']."</span>
									<span class='circle'></span>
									
								</div>
								<div class='content'>
									<p>
									".$result[$i]['memo']."
									</p>
									<img src='".$result[$i]['imagepath'].$result[$i]['image']."'style='width:100%;height:50%;'/>
								</div>
							</li> ";
			}else{
				$content .= " <li class='work'>
								<input class='radio' id='work".$i."' name='works' type='radio'checked>
								<div class='relative'>
									<label for='work".$i."'>".$result[$i]['name']."</label>
									<span class='date'>".$result[$i]['regdate']."</span>
									<span class='circle'></span>
									</div>
									<div class='content'>
									<p>
									".$result[$i]['memo']."
									</p>
									<img src='".$result[$i]['imagepath'].$result[$i]['image']."'style='width:100%;height:50%;'/>
								</div>
							  </li> ";
			
			}
		}
		echo $content;

	}


	public function timeline_insert(){
		$timeline_model = $this->loadModel('TimelineModel');
		
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
				case UPLOAD_ERR_NO_FILE:
					echo "파일이 첨부되지 않았습니다. ($error)";
					break;
				default:
					echo "파일이 제대로 업로드되지 않았습니다. ($error)";
			}
			exit;
		}
		 
		// 확장자 확인
		if( !in_array($ext, $allowed_ext) ) {
			echo "허용되지 않는 확장자입니다.";
			exit;
		}
		 
		// 파일 이동
		move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$filename");


		$timeline_model->timeline_insert($name, $memo, $filename);


		echo"<script>location.href='/timeline/index'</script>";
	}

}
