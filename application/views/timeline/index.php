<style>
elector img{
position: absolute; top:0; left: 0;
width: 60%;
height: 60%;

</style>
<script>


$(function(){
	$('#loading').hide();
	list_select();
});
$(window).scroll(function(){   //스크롤이 최하단 으로 내려가면 액션
     if($(window).scrollTop() >= $(document).height() - $(window).height()){
		list_select();
     } 
});

function list_select(){
	
	var start_cnt = $("#start_cnt").val();
	var end_cnt = $("#end_cnt").val();
	start_cnt *=1;
	end_cnt *=1;




		$.ajax({
			url : '/timeline/timeline_list2',
			type : 'post',
			data : {
				'start_cnt': start_cnt,
				'end_cnt': end_cnt
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
				new Vue({
				  el: '#timeline',
				  data: {
					posts: [] // initialize empty array
				  },
				  mounted() { // when the Vue app is booted up, this is run automatically.
					var self = this // create a closure to access component in the callback below
					  self.posts = json;
				  }
				})
			}
		});
	
	$("#start_cnt").val(start_cnt + 10);
	
	
}


/*구버전
function list_select(){
	//$("#timeline").empty();
	var start_cnt = $("#start_cnt").val();
	var end_cnt = $("#end_cnt").val();
	start_cnt *=1;
	end_cnt *=1;
    $.get("/timeline/timeline_list" ,
        {
            start_cnt : start_cnt,
			end_cnt : end_cnt
        },
        function(rslt){
			if(start_cnt == 0){
				$("#timeline").html(rslt);
			}else{
				$("#timeline").append(rslt);
			}
        });
	$("#start_cnt").val(start_cnt + 10);
	$("#end_cnt").val(end_cnt + 10);
	
}
*/
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
<input type="hidden" name='start_cnt' id="start_cnt" value="0"/>
<input type="hidden" name='end_cnt' id="end_cnt" value="10"/>


<ul id='timeline'>
	<li v-for="(item, index) in posts" class='work'>
		<input class='radio' name='works' type='radio'checked>
		<div class='relative'>
			<label for='work'>{{item.name}}</label>
			<span class='date'>{{item.regdate}}</span>
			<span class='circle'></span>
		</div>
		<div v-if="item.image != '' " class='content'>
			<p>{{item.memo}}</p>
			<img v-bind:src="item.imagepath+''+item.image" style='width:50%;height:50%;margin-left: auto; margin-right: auto; display: block;'/>	
		</div>
		<div v-else class='content'>
			<p>{{item.memo}}</p>
		</div>
	</li>
</ul>

