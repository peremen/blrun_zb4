
//====================[ sw_edit 파일명: write.js ]====================

var use_category_yn = document.getElementById("use_category_yn").value;
var member_yn = document.getElementById("member_yn").value;
var subeva_yn = document.getElementById("subeva_yn").value;	

function check_submit_n()
{
	if(document.check_attack.check.value==1)
	{
		alert('글쓰기 버튼을 여러번 누르시면 안됩니다.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(use_category_yn == "Y")
	{
		var myindex=document.getElementById('write').category[1].selectedIndex;
		if (myindex<1)
		{
			alert('카테고리를 선택하여 주세요.');
			document.getElementById('write').category[1].focus();
			return false;
		}
	}

	if(member_yn == "Y")
	{
		if(!document.write.password.value)
		{
			alert('암호를 입력하여 주세요.\n\n암호를 입력하셔야 수정/삭제를 할 수 있습니다.');
			document.write.password.focus();
			return false;
		}

		if(!document.write.name.value)
		{
			alert('이름을 입력하여 주세요.');
			document.write.name.focus();
			return false;
		}
	}

	if(!document.write.subject.value)
	{
		alert('제목을 입력하여 주세요.');
		document.write.subject.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
	}		
	
	if(subeva_yn == "Y")
	{
		if(edit_tag_yn == "Y")
		{
			if(document.getElementById("subject").value && memoiW.document.body.innerHTML) { sub_val_ins(); }
		} else {
			if(document.getElementById("subject").value && memoE.value) { sub_val_ins(); }
		}
	}

	sw_mcpy();

	document.check_attack.check.value=1;
	show_waiting();
	hideImageBox();

	return true;
}

function sub_val_ins()
{
	var subjectE = document.getElementById("subject").value;
	var sub_style_SE = document.getElementById("sub_style_S").value;
	var sub_style_EE = document.getElementById("sub_style_E").value;
	
	if(!sub_style_SE)
	{
		sub_style_EE = "";
	}

	if(document.getElementById("sub_fwet").checked == true)
	{
		sub_style_SE = sub_style_SE + "<b>";
		sub_style_EE = "</b>" + sub_style_EE;
	}
	if(document.getElementById("sub_funderl").checked == true)
	{
		sub_style_SE = sub_style_SE + "<u>";
		sub_style_EE = "</u>" + sub_style_EE;
	}
	if(document.getElementById("sub_fmarq").checked == true)
	{
		sub_style_SE = sub_style_SE + "<marquee>";
		sub_style_EE = "</marquee>" + sub_style_EE;
	}

	document.getElementById("subject").value = sub_style_SE + subjectE + sub_style_EE;
}

function sub_style_chg(obj)
{
	document.getElementById("sub_fcolor").style.backgroundColor=obj;
	document.getElementById("sub_style_S").value = "<font color="+obj+">";
}

function sw_preview()
{
	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		document.getElementById("memo").value = memoE.value;
	}

	if(!document.write.subject.value)
	{
		alert('제목을 입력하여 주세요.');
		document.write.subject.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
	}
	view_preview();
}

function preview_m()
{
	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		document.getElementById("memo").value = memoE.value;
	}

	if(!document.write.subject.value)
	{
		alert('제목을 입력하여 주세요.');
		document.write.subject.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('내용을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('내용을 입력하여 주세요..');
			document.write.memo.focus();
			return false;
		}
	}
	document.write.action = "view_preview.php";
	document.write.target = "_blank";
	document.write.submit();
	document.write.action = sw_d_zb_self_dir + sw_skins_dir + "/write_ok.php";
	document.write.target = "_self";
}

function sw_imagebox(id)
{
	if (document.write.htChk.checked) {
		showImageBox(id);					
	} else {		
		alert('HTML 체크후 사용하세요.');	
	}
}

function sw_codebox(id)
{
	if (document.write.htChk.checked) {
		showCodeBox(id);					
	} else {		
		alert('HTML 체크후 사용하세요.');	
	}
}

function sw_mcpy()
{
	var mcpy_msg = "등록 실패를 대비하여 작성하신 내용을 복사 하시겠습니까?\n\n등록 실패시 Ctrl + V 로 붙여넣기 하시면 됩니다.";
	
	if(edit_tag_yn == "Y")
	{
		if(confirm(mcpy_msg))
		{
			memoiW.document.execCommand("SelectAll");
			memoiW.document.execCommand("Copy");
		}
	} else {
		if(confirm(mcpy_msg))
		{
			memoE.select();
			memoE.createTextRange().execCommand("Copy");
		}
	}
}
