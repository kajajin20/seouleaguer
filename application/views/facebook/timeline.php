<html>
<head>
<link href="/public/css/facebook.css" type="text/css" rel="stylesheet"/>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="/public/js/vue.js"></script>
</head>
<body>
<?php 
session_start();
?>
<script>
$(function(){
	$('#loading').hide();
	var end_cnt = $("#end_cnt").val();
	end_cnt *=1;
	list.event(end_cnt); // 최초 리스트 호출
	$("#end_cnt").val(end_cnt + 10);

	$('#btn-upload').click(function(e){
		e.preventDefault();             
		$("input:file").click();               
		var ext = $("input:file").val().split(".").pop().toLowerCase();
		if(ext.length > 0){
			if($.inArray(ext, ["gif","png","jpg","jpeg"]) == -1) { 
				alert("gif,png,jpg 파일만 업로드 할수 있습니다.");
				return false;  
			}                  
		}
		$("input:file").val().toLowerCase();
	});  
	
});

$(window).scroll(function(){   //스크롤이 최하단 으로 내려가면 액션
     if($(window).scrollTop() == $(document).height() - $(window).height()){
	 
		 console.log("scrollTop: "+$(window).scrollTop());
		 console.log("document_height: "+$(document).height());
		 console.log("window_height: "+$(window).height());
	    //스크롤 이벤트후 end_cnt 값더한후 리스트 호출
		var end_cnt = $("#end_cnt").val();
		end_cnt *=1;
		$("#end_cnt").val(end_cnt + 10);
		list.event(end_cnt); 
     } 
});
function logout(){
	$.ajax({
		url : '/facebook/logout_action',
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
				location.href = "/facebook/index";
			}
		}
	});
	
}

function insert_submit(){
	if($("#name").val() == ""){
		alert("등록자를 입력해주세요.");
		return false;
	}
	if($("#memo").val() == ""){
		alert("내용을 입력해주세요.");
		return false;
	}
	$("#frm_input").submit();
	
}
</script>


<div id="header_wrapper">
 <div id="header">
 <li id="sitename"><a href="/facebook/index">facebook</a></li>
 <form action="post">
 <li><button type="button" onclick="logout();">로그아웃</button></li>
 <input type="hidden" id="end_cnt" value="10">
 </form>
 </div>
</div>

<div id="div3">
	<div class="box" id="timeline"> 
		<div class="contents_title">
			<form class="form_default" roll="group"  action="/facebook/timeline_insert" name="frm_input" id="frm_input"  method="post" enctype="multipart/form-data">
				<img style="border-radius: 50%;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<textarea id="memo" name="memo" style="border:0;" placeholder="<?php echo $_SESSION['name'];?>님, 무슨 생각을 하고 계신가요?">
				</textarea>
				<input type="file" name="myfile" id="myfile"></br>
				<input type="hidden" name="name" id="name" value="<?php echo $_SESSION['name'];?>"></br>
				<button id='btn-upload' class="button1 white selected" onfocus="this.blur();">사진</button>
				<button id='btn-insert' type="button" onclick="insert_submit();">게시</button>
			</form>
		</div>
		<div v-for="post in posts" class="timeline" >
			<div class="title">
				<img style="border-radius: 50%;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span>{{post.name}}</span>
			</div>
			<div class="contents">
				<p>{{post.memo}}</p>
			</div>
			<div v-if="post.image != '' " class="contents_img">
				<img v-bind:src="post.imagepath+''+post.image" style='height: 100%; width: 100%; object-fit: contain'/>
			</div>
			<div v-else>
			</div>
		</div>
	</div>
</div>
<script>
var list = new Vue({
	el: '#timeline',
	data: {
		posts: []
	},
	methods: {
		//리스트출력 이벤트
		event: function (end_cnt) {
			fetch('/timeline/timeline_list2?start_cnt=0&end_cnt='+end_cnt+'',{
				method:'GET'//GET 메소드
				
			}).then((response)=>{
					if(response.ok){
						return response.json();
					}
					throw new Error('error');

			}).then((json)=>{
				this.posts = json;

			})
			.catch((error)=>{
				console.log(error);
			});
		}
	}
});
</script>
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