<html>
<head>
<link href="/public/css/facebook.css" type="text/css" rel="stylesheet"/>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="/public/js/vue.js"></script>
</head>
<body>
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
			url : '/facebook/login_action',
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
					location.href = "/facebook/timeline";
				}else {
					alert('아이디와 비밀번호가 일치하지 않습니다.');
				}
			}
		});
		
	}

	function setValidate(){
		
		var name = "";

		if($("#firstname").val() == ""){
			alert("성을 입력하셔야 합니다.");
			return false;
		}	
		if($("#surname").val() == ""){
			alert("이름을 입력하셔야 합니다.");
			return false;
		}	
		if($("#joinid").val() == ""){
			alert("아이디를 입력하셔야 합니다.");
			return false;
		}
		if($("#joinpassword").val() == ""){
			alert("비번을 입력하셔야 합니다.");
			return false;
		}
		name = $("#firstname").val()+$("#surname").val();
		if($('input:radio[name=sex1]').is(':checked')){
			$("#sex").val('W');
		}else if($('input:radio[name=sex1]').is(':checked')){
			$("#sex").val('M');
		}



		$("#name").val(name);
		
		insert_submit();
	}

	function insert_submit(){
		$.ajax({
			url : '/facebook/join_action',
			type : 'post',
			data : {
				'id': $('#joinid').val(),
				'name': $('#name').val(),
				'password': $('#joinpassword').val(),
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
					location.href="/facebook/index";
				}else if(json['msg'] ==='id_chk'){
					alert('중복된 아이디가 있습니다.');
				}
			}
		});
		
	}
</script>
<div id="header_wrapper">
 <div id="header">
 <li id="sitename"><a href="/facebook/index">facebook</a></li>
 <form action="post">
 <li>이메일 또는 휴대폰<br><input type="text" name="id" id="id"></li>
 <li>비밀번호<br><input type="password" name="password" id="password" ><br><a href="">Forgotten account?</a></li>
 <li><button type="button" onclick="login();">로그인</button></li>
 </form>
 </div>
</div>

<div id="wrapper">

<div id="div1">
<p>짭Facebook에서 전세계에 있는 친구, 가족, 지인들과 함께 이야기를 나눠보세요.</p>
<img src="https://www.facebook.com/rsrc.php/v3/yc/r/GwFs3_KxNjS.png">
</div>

<div id="div2">
<h1>가입하기</h1>
<p>항상 지금처럼 무료로 즐겨용!!</p>
<li><input type="text" placeholder="성(姓)" id="firstname"><input type="text" placeholder="이름(성은 제외)" id="surname"></li>
<li><input type="text" id="joinid" placeholder="아이디"></li>
<li><input type="password" id="joinpassword" placeholder="새 비밀번호"></li>
<input type="hidden" id="name">
<input type="hidden" id="sex">
<!--
<p>Birthday</p>
<li>
<select><option>Day</option></select>
<select><option>Month</option></select>
<select><option>Year</option></select>
<a href="">Why do I need to provide my date of birth?</a>
</li>
-->
<li><input type="radio" name="sex1" value="W">여성 <input type="radio" name="sex2" value="M">남성</li>
<li id="terms">By clicking Create an account, you agree to our <a href="">Terms</a> and that <br>you have read our <a href="">Data Policy</a>, including our <a href="">Cookie Use</a>.</li>
<li><button type="button" onclick="setValidate();">가입하기</button></li>
<li id="create_page"><a href="">Create a Page</a> for a celebrity, band or business.</li>
</div>

</div>

<div id="footer_wrapper">

<div id="footer1">
English (UK) <a href="">हिन्दी</a><a href="">ਪੰਜਾਬੀ</a><a href=""> اردو</a><a href="">தமிழ்</a><a href="">বাংলা</a><a href="">मराठी</a><a href="">తెలుగు</a><a href="">ગુજરાતી</a><a href="">ಕನ್ನಡ</a><a href="">മലയാളം</a>
</div>
<div id="footer2">
<a href="">Sign Up</a><a href="">Log In</a><a href="">Messenger</a><a href="">Talkerscode</a><a href="">Mobile</a><a href="">Find Friends</a><a href="">Badges</a><a href="">People</a><a href="">Pages</a><a href="">Places</a><a href="">Games</a><a href="">Locations</a><a href="">Celebrities</a><a href="">Groups</a><a href="">Moments</a><a href="">About</a><a href="">Create Advert</a><a href="">Create Page</a><a href="">Developers</a><a href="">Careers</a><a href="">Privacy</a><a href="">Cookies</a><a href="">Ads</a><a href="">Terms</a><a href="">Help</a>
<p>Design By TalkersCode.com</a>
</div>

</div>
</body>
</html>