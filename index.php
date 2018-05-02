<!DOCTYPE html>
<html>
<head>
<title>회원가입</title>
<link rel="stylesheet" href="/test/css/join.css" />
</head>

<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
	function login(){

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
				}else {
					alert('아이디나 비밀번호가 일치하지 않습니다.');
				}
			}
		});
		
	}
	
</script>	
<body>
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
</body>
</html>