
$(document).ready(function(){
	
	//checkbox
	$('input[type="checkbox"], input[type="radio"]').each(function() {
		var thisClass = $(this).attr('class');
		var label  = $(this).data('label');
		if($(this).parent().hasClass('myform')) {
			//
		} else {
			$(this).wrap('<label class="myform center '+ thisClass + '"></label>');
			if(typeof label !== typeof undefined && label !== '') {			
				if($(this).hasClass('radio-btn')) {
					$(this).after('<span>' + label + '</span>');
				} else if($(this).hasClass('checkbox-btn')) { 
					$(this).after('<span>' + label + '</span>');				
				} else {
					$(this).after('<span></span>' + label);
				}
			}
			$(this).removeClass();
		}
	});


	
	
	$('label.toggle-light').each(function() {
		var label1 = $(this).find('input').data('on');
		var label2 = $(this).find('input').data('off');
		$(this).append('<span></span>');
		$(this).append('<span class="labelOn">' + label1 + '</span>');
		$(this).append('<span class="labelOff">' + label2 + '</span>');
	});


	//lable input 박스
	$('input:not([type="checkbox"]):not([type="radio"])').each(function() {
		//if($(this).val()) 
			//$(this).addClass('filled');

		var placeholder  = $(this).data('placeholder');
		var label_left = $(this).data('label-left');
		var label_right = $(this).data('label-right');
		
		

		if(typeof label_left !== typeof undefined && label_left !== '' || typeof label_right !== typeof undefined && label_right !== '') {
			$(this).wrap('<label class="myform"></label>');
			if(typeof label_left !== typeof undefined && label_left !== '') {
				if(typeof label_right !== typeof undefined && label_right !== '') {
					$(this).before('<span class="inp-label">' + label_left + '</span>');
				} else {
					$(this).before('<span class="inp-label left">' + label_left + '</span>');
					$(this).addClass('border-left-none');
				}

			}
			if(typeof label_right !== typeof undefined && label_right !== '') {
				$(this).after('<span class="inp-label right">' + label_right + '</span>');
				$(this).addClass('border-right-none');
			}			
		}
	});

	$('input.search').each(function() {
		$(this).wrap('<label class="mySearch"></label>');
		$(this).after('<span class="icon-search"></span>');
	});


	$('input:not([type="checkbox"]):not([type="radio"])').bind("keyup", function() {
		var val = $(this).val();
		if(val) {		
			$(this).addClass('filled');		
			//$(this).next('.btnSubmit').addClass('filled');
		} else {
			$(this).removeClass('filled');
			//$(this).next('.btnSubmit').removeClass('filled');
		}
	});

	$('select').change(function (){
		if($(this).val()) {		
			$(this).parent().addClass('filled');		
		} else {
			$(this).parent().removeClass('filled');
		}
	});
			

	//숫자만 입력
	$("input.number, .myform.number input").bind("keyup", function() {
		$(this).val($(this).val().replace(/[^0-9]/g,""));
	});

	//휴대폰 번호 입력
	function phoneFomatter(num,type) {
		var formatNum = '';
		if(num.length==11) {
			if(type==0) {
				formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-****-$3');
			} else {
				formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
			}
		} else if(num.length==8) {
			formatNum = num.replace(/(\d{4})(\d{4})/, '$1-$2');
		} else {
			if(num.indexOf('02')==0) {
				if(type==0) {
					formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-****-$3');
				} else {
					formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
				}
			} else {
				if(type==0){
					formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-***-$3');
				} else {
					formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
				}
			}
		}
		return formatNum;
	}
	$("input.phone, .myform.phone input").bind("keyup", function(event) {
		$(this).val(phoneFomatter($(this).val().replace(/[^0-9]/g,"")));
	});

	
	//textarea 자동조절
	function textareaResize(obj) {
		obj.style.height = "1px";
		obj.style.height = (2+obj.scrollHeight)+"px";
	}
	$("textarea.autosize").bind("keypress", function(event) {
		textareaResize(this);
	});
	$("textarea.autosize").bind("keyup", function(event) {
		textareaResize(this);
	});
	

});