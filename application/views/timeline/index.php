<style>
elector img{
position: absolute; top:0; left: 0;
width: 60%;
height: 60%;

</style>
<script>


$(function(){
	$('#loading').hide();
	var end_cnt = $("#end_cnt").val();
	end_cnt *=1;
	list.event(end_cnt); // 최초 리스트 호출
	$("#end_cnt").val(end_cnt + 10);
	
});
$(window).scroll(function(){   //스크롤이 최하단 으로 내려가면 액션
			 console.log("scrollTop: "+$(window).scrollTop());
		 console.log("document_height: "+$(document).height());
		 console.log("window_height: "+$(window).height());
     if($(window).scrollTop() >= $(document).height() - $(window).height()){
	    //스크롤 이벤트후 end_cnt 값더한후 리스트 호출
		var end_cnt = $("#end_cnt").val();
		end_cnt *=1;
		$("#end_cnt").val(end_cnt + 10);
		list.event(end_cnt); 
     } 
});

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

<h1>타임라인</h1>
</br>
<form class="form_default" roll="group"  action="/timeline/timeline_insert" name="frm_input" id="frm_input"  method="post" enctype="multipart/form-data">
	<span>등록자</span><input type="text" name='name' id="name" /></br>
	<span>내용</span><textarea class ="noresize" name='memo' id="memo" style="width:100%;height:150px" ></textarea></br>
	<span>이미지</span></br>
	<input type="file" name="myfile" id="myfile"></br>
	<button class="button button1" type="button" style="width:100%" onclick="insert_submit();">등록</button>

</form>
<div id="loading"><img id="loading-image" src="/public/img/loading.gif" alt="Loading..." style="width:80px";/></div>
<input type="hidden" name='end_cnt' id="end_cnt" value="10"/>


<ul id='timeline'>
	<li v-for="post in posts" class='work'>
		<input class='radio' name='works' type='radio'checked>
		<div class='relative'>
			<label for='work'>{{post.name}}</label>
			<span class='date'>{{post.regdate}}</span>
			<span class='circle'></span>
		</div>
		<div v-if="post.image != '' " class='content'>
			<p>{{post.memo}}</p>
			<img v-bind:src="post.imagepath+''+post.image" style='width:50%;height:50%;margin-left: auto; margin-right: auto; display: block;'/>	
		</div>
		<div v-else class='content'>
			<p>{{post.memo}}</p>
		</div>
	</li>
</ul>

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

