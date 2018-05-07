<style>
elector img{
position: absolute; top:0; left: 0;
width: 60%;
height: 60%;

</style>
<script>


$(function(){
	list_select();
});
$(window).scroll(function(){   //스크롤이 최하단 으로 내려가면 액션
     if($(window).scrollTop() >= $(document).height() - $(window).height()){
		list_select();
     } 
});

function list_select(){
	//$("#timeline").empty();
	var start_cnt = $("#start_cnt").val();
	var end_cnt = $("#end_cnt").val();
	start_cnt *=1;
	end_cnt *=1;
		$('#loading').show();
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
				var html = "";
				$.each(json,function(index,data){

						html +=	"<li class='work'>";
						html +=		"<input class='radio' name='works' type='radio'checked>";
						html +=		"<div class='relative'>";
						html +=			"<label for='work'>"+data.name+"</label>";
						html +=			"<span class='date'>"+data.regdate+"</span>";
						html +=			"<span class='circle'></span>";
						html +=			"</div>";
						html +=			"<div class='content'>";
						html +=			"<p>"+data.memo+"</p>";
						if(data.image != ""){
							html +=	"<img src='"+data.imagepath+""+data.image+"'style='width:50%;height:50%;'/>";
						}
						html +=	"</div>";
						html +=	"</li>"; 

				})
					$('#loading').hide();
					$("#timeline").append(html);
			}
		});
	$("#start_cnt").val(start_cnt + 10);
	//$("#end_cnt").val(end_cnt + 10);
	
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
	
	$("#frm_input").submit();
	
}
</script>

<h1>타임라인</h1>
</br>
<form class="form_default" roll="group"  action="/timeline/timeline_insert" name="frm_input" id="frm_input"  method="post" enctype="multipart/form-data">
	<span>등록자</span><input type="text" name='name' id="name" /></br>
	<span>내용</span><textarea class ="noresize" name='memo' id="memo" style="width:100%;height:150px" ></textarea></br>
	<span>이미지:</span><input type="file" name="myfile" id="myfile"></br>
	<button class="button" type="button" onclick="insert_submit();">등록</button>

</form>
<div id="loading"><img id="loading-image" src="/public/img/loading.gif" alt="Loading..." /></div>
<input type="hidden" name='start_cnt' id="start_cnt" value="0"/>
<input type="hidden" name='end_cnt' id="end_cnt" value="10"/>
<ul id='timeline'>

</ul>
