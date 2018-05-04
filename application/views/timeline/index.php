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
function insert_submit(){
	
	$("#frm_input").submit();
	
}
</script>

<h2>HoonsTimeline!</h2>
<p>테스트중입니다.</p>
<form class="form_default" roll="group"  action="/timeline/timeline_insert" name="frm_input" id="frm_input"  method="post" enctype="multipart/form-data">
	<span>등록자:</span><input type="text" name='name' id="name" /></br>
	<span>내용:</span><textarea name='memo' id="memo"></textarea></br>
	<span>이미지:</span><input type="file" name="myfile" id="myfile"></br>
	<button type="button" onclick="insert_submit();">회원가입</button>

</form>
<input type="hidden" name='start_cnt' id="start_cnt" value="0"/>
<input type="hidden" name='end_cnt' id="end_cnt" value="9"/>
<ul id='timeline'>

</ul>
<!--
<ul id='timeline'>
  <li class='work'>
    <input class='radio' id='work1' name='works' type='radio' checked>
    <div class="relative">
      <label for='work5'>권성훈</label>
      <span class='date'>12 May 2013</span>
      <span class='circle'></span>
    </div>
    <div class='content'>
	  <img src="/public/img/test2.jpg" width="800" height="200">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio ea necessitatibus quo velit natus cupiditate qui alias possimus ab praesentium nostrum quidem obcaecati nesciunt! Molestiae officiis voluptate excepturi rem veritatis eum aliquam qui laborum non ipsam ullam tempore reprehenderit illum eligendi cumque mollitia temporibus! Natus dicta qui est optio rerum.
      </p>
    </div>
  </li>
</ul>
-->
