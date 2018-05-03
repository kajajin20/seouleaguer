<?php
	include '/var/www/html/test/include/header.php';
?>
<script>
	function login(){
		if($('#id').val() == ""){
			alert("아이디를 입력해주세요.");
			return false;
		}
		if($('#password').val() == ""){
			alert("비번을 입력해주세요.");
			return false;
		}
		$.ajax({
			url : '/test/ajax/login_action.php',
			type : 'post',
			data : {
				'id': $('#id').val(),
				'password': $('#password').val()
			},
			beforeSend: function() {
				//요청전
			},
			complete: function() {
				//요청완료
			},
			error: function() {
				//요청실패
			},
			dataType: 'json',
			success: function(json) {
				if(!json) return;
				if(json['msg'] === 'success') {
					alert('로그인이 완료되었습니다.');
					location.href = "/test/index.php";
				}else {
					alert('아이디와 비밀번호가 일치하지 않습니다.');
				}
			}
		});
		
	}
	function logout(){
		$.ajax({
			url : '/test/ajax/logout_action.php',
			type : 'post',
			data : {

			},
			beforeSend: function() {
				//요청전
			},
			complete: function() {
				//요청완료
			},
			error: function() {
				//요청실패
			},
			dataType: 'json',
			success: function(json) {
				if(!json) return;
				if(json['msg'] === 'success') {
					alert('로그아웃 되었습니다.');
					location.href = "/test/index.php";
				}
			}
		});
		
	}
	
</script>	
<body>
<?php
	session_start();
	if(!$_SESSION['id']){
?>
<div id="stylized" class="myform">
	<form id="form" name="form" method="post">
		<h1>로그인 폼</h1>

		<label>ID
			<span class="small">아이디 입력</span>
		</label>
		<input type="text" name="id" id="id" />

		<label>Password
			<span class="small">패스워드</span>
		</label>
		<input type="password" name="password" id="password" />

		<button type="button" onclick="login();">로그인</button>
		<div class="spacer"></div>
		<button type="button" onclick="location.href='/test/join.php' ">회원가입</button>
		<div class="spacer"></div>
</form>
</div>
<?php
	}else{
?>
<div id="stylized" class="myform">
	<form id="form" name="form" method="post">
		<h1>로그인 계정</h1>

		<label>ID: 
			<span class="small">로그인 아이디</span>
		</label>
		<?php echo $_SESSION['id'];?>
		<button type="button" onclick="logout();">로그아웃</button>
		<div class="spacer"></div>

</form>
</div>
<?php
	}
?>
</body>
<?php
	include '/var/www/html/test/include/footer.php';
?>
