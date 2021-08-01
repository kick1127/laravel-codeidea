<?php include_once('./front/lib/common.lib.php'); ?>
@include('partials.header')

<div class="page-container header-transparent">
	<div id="write">			
		<p class="fs64 mfs30 mt120 mmt50">
			반갑습니다.<br/>
			<span class="pc_only">저희는 </span>코드 아이디어 입니다.
		</p>
		<p class="fs19 mfs18 mt40 mmt20">
			안녕하세요. 코드 아이디어 입니다. <br class="mobile_only">저희는 신생 스타트업으로 긍정적이고 진취적인 마인드를 가지고 일합니다.<br/>
			간단한 문의사항들 적어주시고 문희사항들은 저희 인포쪽으로 문의주세요.
		</p>
		<p class="fs18 mt40" style="line-height:2em;">
			<span>Co : www.code-idear.com</span><br class="mobile_only">
			<span class="ml40 mml0">Co Number : 508-20-64700</span><br class="mobile_only">
			<span class="ml40 mml0">Tel : 010-5440-5414</span><br class="mobile_only">
			<span class="ml40 mml0">Email : huchiy@gmail.com</span>
		</p>

		<div class="visual-img" style="">
			<div class="imageHolder"><span class="ani-contact"></span><!--<img src="./img/contact/img01.png">--></div>
		</div>

		<div class="wr-wrap mt70">
			<form id="contact-form" name="contact-form" action="{{ route('front.contact') }}" method="post">
				@csrf

				<div class="wr-list">
					<div class="wr-head">01. 어떤 서비스를 필요로 하신가요?</div>
					<div class="wr-list-con">
						<input type="checkbox" class="checkbox-btn" name="service" value="web-dev" data-label="웹개발">
						<input type="checkbox" class="checkbox-btn" name="service" value="app-deb" data-label="앱개발">
						<input type="checkbox" class="checkbox-btn" name="service" value="web-design" checked data-label="웹디자인">
						<input type="checkbox" class="checkbox-btn" name="service" value="app-design" data-label="앱디자인">
						<input type="checkbox" class="checkbox-btn" name="service" value="si" data-label="유지보수">
						<input type="checkbox" class="checkbox-btn" name="service" value="viral" data-label="바이럴마케팅">
						<input type="checkbox" class="checkbox-btn" name="service" value="banner" data-label="배너광고">
						<input type="checkbox" class="checkbox-btn" name="service" value="video" checked data-label="영상광고">
						<input type="checkbox" class="checkbox-btn" name="service" value="influ" data-label="인플루언서">
						<input type="checkbox" class="checkbox-btn" name="service" value="digital" data-label="디지털콘텐츠">
						<input type="checkbox" class="checkbox-btn" name="service" value="commerce" data-label="이커머스">
						<input type="checkbox" class="checkbox-btn" name="service" value="etc" data-label="etc">
					</div>
				</div>		
			
				<div class="wr-list ">
					<div class="wr-head">02. 프로젝트에 관해 설명해주세요.</div>
					<div class="flex-row">
						<div class="wr-list-con">
							<span class="label required">이름</span>
							<input type="text" name="username" class="span" placeholder="">
						</div>
						<div class="wr-list-con">
							<span class="label required">회사명</span>
							<input type="text" name="co_name" class="span" placeholder="">
						</div>
					</div>
					<div class="flex-row">
						<div class="wr-list-con">
							<span class="label required">이메일</span>
							<input type="email" name="email" class="span" placeholder="">
						</div>
						<div class="wr-list-con">
							<span class="label required">전화번호</span>
							<input type="tel" name="phone" class="span phone" placeholder="">
						</div>
					</div>
				</div>

				<div class="wr-list ">
					<div class="wr-head">03. 자세한 내용을 기입해주세요.</div>
					<div class="wr-list-con">
						<textarea id="description" class="span" style="height:290px" placeholder="내용을 기입해주세요"></textarea>
					</div>
				</div>

				<div class="wr-list ">
					<div class="wr-list-con">
						<p class="mb10 mmb5"><span class="mfs18">첨부파일</span><span class="color-gray ml5 pc_only">(이력서, 자기소개서, 디자이너 포트폴리오는 필수입니다. 여러개의 파일은 압축해서 100MB이하 ZIP파일로 올려주세요)</span></p>					
						<p class="color-gray mobile_only mt10">(이력서, 자기소개서, 디자이너 포트폴리오는 필수입니다. 여러개의 파일은 압축해서 100MB이하 ZIP파일로 올려주세요)</p>
						<input type="file" name="file" />
					</div>
				</div>
			</form>
			<div class="wr-list ">
				<div class="wr-list-con">
					<label class="myform"><input type="checkbox" name="must"><span></span><span class="mainColor">개인정보 처리방침</span>에 동의합니다. <span class="mainColor">(필수)</span></label>
				</div>
			</div>
		</div>

		<div class="mt60 tcenter">			
			<a href="#" class="btn blue large span200" id='btn_send'>SEND</a>
		</div>
	</div>
</div>


<script>
<?php if (!$chkMobile) { //pc전용 ?>
$(document).on("mousemove", function(event) {
	var window_height = $('#write').height();
	var window_width = $(this).width();
	var mouseXpos = event.clientX;
	var mouseYpos = event.clientY;
	var YrotateDeg = (window_width / 2 - mouseXpos) * 0.002;
	var XrotateDeg = (window_height / 2 - mouseYpos) * -0.002;
	$(".visual-img").css(
	"transform",
	"rotateX(" + XrotateDeg + "deg) rotateY(" + YrotateDeg + "deg)"
	);
});
<?php } ?>

var filename = "";

$(document).ready(function(){
	//file
	$('input[type="file"]:not(.default)').each(function(index) {
		var className = $(this).attr('class') ? $(this).attr('class') : '';
		var btnName = $(this).attr('data-btn-name') ? $(this).attr('data-btn-name') : '파일찾기';
		$(this).wrap('<div class="filebox ' + className + '"></div>');
		$(this).parent().siblings('.upImg').insertAfter($(this));
		$(this).before('<input type="text" value="선택된 파일 없음. (파일 업로드 pdf, zip 3Mb max)" class="upload-name" disabled="disabled"><label for="upload_' + index + '" class="upload-btn">' + btnName + '</label>');
		$(this).attr('id', 'upload_' + index);
		$(this).addClass('upload-hidden');
		$(this).on('change', function(){ // 값이 변경되면
			if(window.FileReader){ // modern browser
				filename = $(this)[0].files[0].name;
			} else { // old IE
				filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
			} // 추출한 파일명 삽입
			$(this).siblings('.upload-name').val(filename);			
			// $.ajax({
			// 	url: '',
			// 	processData: false,
			// 	contentType: false,
			// 	data: formData,
			// 	type: 'POST',
			// 	success: function(result){
			// 		alert("업로드 성공!!");
			// 	}
			// });
		});
	});
});

$(function() {	
	$('#btn_send').click(function() {
		// if(check_values()) {			
			$('#contact-form').submit();		
		// }
	});

	return false;
});

function check_values() {
	if ($("input:checkbox[name='service']").is(":checked")==false) {
		alert("1개 이상의 서비스를 선택해주세요.");
		return false;
	}
	if ($.trim($("input[name=username]").val()).length < 1) {
		alert("이름을 입력해주세요.");
		return false;			
	}				
	if ($.trim($("input[name=co_name").val()).length < 1) {
		alert("회사명을 입력해주세요.");
		return false;			
	}
	if ($.trim($("input[name=email]").val()).length < 1) {
		alert("이메일을 입력해주세요.");
		return false;			
	}
	if ($.trim($("input[name=phone]").val()).length < 1) {
		alert("연락처를 입력해주세요.");
		return false;			
	}
	if ($.trim($("#description").val()).length < 1) {
		alert("요청 및 문의 사항을 기입해주세요.");
		return false;			
	}
	//TODO: find getting object method to check the file
	if (filename=="") {
		alert("파일을 첨부해주세요.");
		return false;			
	}	
	if ($("input:checkbox[name='must']").is(":checked")==false) {
		alert("개인정보 처리방침에 동의해주세요.");
		return false;
	}

	return true;	
}
</script>

@include('partials.footer')