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
<div class="menu_header">
	<ul id="nav">
		<li class="nav_main"><a href="#"><img src="/public/img/facebook_icon.jpg"/></a></li>
		<span id="s1"></span>
		<li class="subs">
			<input type="text" placeholder="검색" style="border:0" />
		</li>
		<span id="s2"></span>
		<li><a href="#"><img src="/public/img/search_img.jpg"/></a></li>
		<li class="nav_menu"><img style="border-radius: 50%;width:28px;margin-left:10px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/></li>
		<li class="subs"><a href="#">권성훈</a>
			<ul>
				<li><a href="javascript:logout();">로그아웃</a></li>
			</ul>
		</li>
		<li><a href="#">홈</a></li>
		<li><a href="#">친구찾기</a></li>

		<li><img src="/public/img/facebook_menu_all.jpg"/></li>

	</ul>
</div>
<!--
<div id="header_wrapper">
 <div id="header">
 <li id="sitename"><a href="/facebook/index">facebook</a></li>
 <form action="post">
 <li><button type="button" onclick="logout();">로그아웃</button></li>
 <input type="hidden" id="end_cnt" value="10">
 </form>
 </div>
</div>
-->
<input type="hidden" id="end_cnt" value="10">
<div id="div3">
	<div class="box2">
		<div>권성훈</div>
		<div>뉴스피드</div>
		<div>Messager</div>
		<div>이벤트</div>
		<div>그룹</div>
		<div>페이지</div>
		<div>친구목록</div>
		<div>친구</div>
		<div>과거의 오늘</div>
		<div>페이지 피드</div>
		<div>친구찾기</div>
		<div>인사이트</div>
		<div>사진</div>
	</div>

	<div class="box" id="timeline"> 
		<div class="contents_title">
			<form class="form_default" roll="group"  action="/facebook/timeline_insert" name="frm_input" id="frm_input"  method="post" enctype="multipart/form-data">
				<img style="border-radius: 50%;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<textarea id="memo" name="memo" style="border:0;" placeholder="<?php echo $_SESSION['name'];?>님, 무슨 생각을 하고 계신가요?">
				</textarea>
				<input type="file" name="myfile" id="myfile"></br>
				<input type="hidden" name="name" id="name" value="<?php echo $_SESSION['name'];?>"></br>
				<hr style="border:solid 0.7px #e9ebee;"></br>
				<button id='btn-upload' class="button1 white selected" onfocus="this.blur();"><img src="/public/img/picture_img.jpg"/></button>
				<button id='btn-insert' type="button" onclick="insert_submit();"><img src="/public/img/insert_button.jpg"/></button>
			</form>
		</div>
		<div v-for="post in posts" class="timeline" >
			<div class="title">
				<img style="border-radius: 50%;vertical-align:top;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
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
			<div class="contents_good">
				<hr style="border:solid 0.7px #e9ebee;">
				<img src="/public/img/good_img.jpg" style="width:100%;"/>
			</div>
		</div>
	</div>
	<div class="box3">
		<div class="story" >
			<div class="contents">
				<p>스토리</p>
			</div>
			<div class="title">
				<img style="border-radius: 50%;vertical-align:top;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span>친구</span>
			</div>
		</div>
		<div class="story" >
			<div class="contents">
				<p>게임</p>
			</div>
			<div class="title">
				<img style="vertical-align:top;" src="/public/img/game_img.jpg"/>
			</div>
			<div class="contents">
				<p>재미없는 게임 광고입니다~</p>
			</div>
		</div>
		<div class="story" >
			<div class="contents">
				<p>추천페이지</p>
			</div>
			<div class="title">
				<img style='width: 100%; object-fit: contain' src="/public/img/chuchen_img.jpg"/>
			</div>
		</div>
	</div>

	<div class="box4">
		<div class="connect_friends" >
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">성훈이</span>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">지현이</span>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">무경이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">주성이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">창오</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">재철이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">국진이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">정태</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">다슬이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
				</br>
			</div>
			<div class="connect_friends_title">
				<img style="border-radius: 50%;vertical-align:middle;width:30px;" src="https://scontent-icn1-1.xx.fbcdn.net/v/t1.0-1/c12.0.40.40/p40x40/10354686_10150004552801856_220367501106153455_n.jpg?_nc_cat=0&oh=1c89983047e057864f13e827a959b539&oe=5B9829F8"/>
				<span class="connect_friends_name">은정이</span>
				<img style="vertical-align:middle;position:absolute;right:10%;" src="/public/img/green_point.jpg"/>
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