<!DOCTYPE html>
<html>
<head>
<title>회원가입</title>
<link rel="stylesheet" href="/test/css/join.css" />
</head>
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
	function insert_submit(){

		$.ajax({
			url : '/test/ajax/join_action.php',
			type : 'post',
			data : {
				'id': $('#id').val(),
				'name': $('#name').val(),
				'password': $('#password').val(),
				'email': $('#email').val(),
				'age': $('#age').val(),
				'sex': $('#sex').val()
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
					alert('회원가입이 완료되었습니다.');
				}else if(json['msg'] ==='id_chk'){
					alert('중복된 아이디가 있습니다.');
				}
			}
		});
		
	}
	
</script>
<body>
<div id="stylized" class="myform">
	<form id="insert_form" name="form" action="join_action.php" method="post">
		<h1>회원가입 폼</h1>

		<label>ID
			<span class="small">아이디 입력</span>
		</label>
		<input type="text" name="id" id="id" />
		<label>이름
			<span class="small">이름 입력</span>
		</label>
		<input type="text" name="name" id="name" />
		<label>비번
			<span class="small">비번 입력</span>
		</label>
		<input type="password" name="password" id="password" />
		<label>비번확인
			<span class="small">비번 입력</span>
		</label>
		<input type="password" name="password_chk" id="password_chk" />
		<label>이메일
			<span class="small"></span>
		</label>
		<input type="text" name="email" id="email" />
		<label>나이
			<span class="small">숫자입력</span>
		</label>
		<input type="number" name="age" id="age" />
		<label>성별
			<span class="small">선택</span>
		</label>
		<select name="sex" id="sex">
		  <option value="M">남자</option>
		  <option value="W" selected="selected">여자</option>
		</select>
		
		<button type="button" onclick="insert_submit();">가입하기</button>
		<div class="spacer"></div>
</form>
</div>
</body>
</html>