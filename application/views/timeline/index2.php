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

						html += "<div class='demo-card demo-card--step1'>";
						html +=		"<div class='head'>";
						html +=		"<div class='number-box'>";
						html +=			"<span>"+index+"</span>";
						html +=		"</div>";
						html +=		"<h2><span class='small'>"+data.regdate+"</span> "+data.name+"</h2>";
						html +=		"</div>";
						html +=		"<div class='body'>";
						html +=			"<p>"+data.memo+"</p>";
						html +=			"<img src='"+data.imagepath+""+data.image+"' alt='Graphic'>";
						html +=		"</div>";
						html +=	"</div>";
				})
					$("#timelinearea").append(html);
			}
		});
	$("#start_cnt").val(start_cnt + 10);
	$("#end_cnt").val(end_cnt + 10);
	
}
</script>
<input type="text" name='start_cnt' id="start_cnt" value="0"/>
<input type="text" name='end_cnt' id="end_cnt" value="9"/>
<section id=timeline>
	<h1>A Flexbox Timeline</h1>
	<p class="leader">All cards must be the same height and width for space calculations on large screens.</p>
	<div class="demo-card-wrapper" id="timelinearea">

    
	</div>
</section>