
//====================[ sw_edit ���ϸ�: write.js ]====================

var use_category_yn = document.getElementById("use_category_yn").value;
var member_yn = document.getElementById("member_yn").value;
var subeva_yn = document.getElementById("subeva_yn").value;	

function check_submit_n()
{
	var rName=document.getElementById('name');
	var rPass=document.getElementById('password');
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');
	var rCheck=document.getElementById('check');
	if(document.check_attack.check.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		rStr.value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(use_category_yn == "Y")
	{
		var myindex=document.getElementById('write').category[1].selectedIndex;
		if (myindex<1)
		{
			alert('ī�װ��� �����Ͽ� �ּ���.');
			document.getElementById('write').category[1].focus();
			return false;
		}
	}

	if(member_yn == "Y")
	{
		if(!rPass.value)
		{
			alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �� �� �ֽ��ϴ�.');
			rPass.focus();
			return false;
		}

		if(!rName.value)
		{
			alert('�̸��� �Է��Ͽ� �ּ���.');
			rName.focus();
			return false;
		}
	}

	if(!rSub.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���..');
			rStr.focus();
			return false;
		}
	}		
	
	if(subeva_yn == "Y")
	{
		if(edit_tag_yn == "Y")
		{
			if(rSub.value && memoiW.document.body.innerHTML) { sub_val_ins(); }
		} else {
			if(rSub.value && memoE.value) { sub_val_ins(); }
		}
	}

	sw_mcpy();

	rCheck.value=1;
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
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');
	if(edit_tag_yn == "Y")
	{
		rStr.value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		rStr.value = memoE.value;
	}

	if(!rSub.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���..');
			rStr.focus();
			return false;
		}
	}
	view_preview();
}

function preview_m()
{
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');
	if(edit_tag_yn == "Y")
	{
		rStr.value = memoi2memo(memoiW.document.body.innerHTML);
	} else {
		rStr.value = memoE.value;
	}

	if(!rSub.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		rSub.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('������ �Է��Ͽ� �ּ���..');
			rStr.focus();
			return false;
		}
	}
	var rWrite=document.getElementById('write');
	rWrite.action = "view_preview.php";
	rWrite.target = "_blank";
	rWrite.submit();
	rWrite.action = sw_d_zb_self_dir + sw_skins_dir + "/write_ok.php";
	rWrite.target = "_self";
}

function sw_imagebox(id)
{
	if (document.getElementById('htChk').checked) {
		showImageBox(id);					
	} else {		
		alert('HTML üũ�� ����ϼ���.');	
	}
}

function sw_codebox(id)
{
	if (document.getElementById('htChk').checked) {
		showCodeBox(id);					
	} else {		
		alert('HTML üũ�� ����ϼ���.');	
	}
}

function sw_mcpy()
{
	var mcpy_msg = "��� ���и� ����Ͽ� �ۼ��Ͻ� ������ ���� �Ͻðڽ��ϱ�?\n\n��� ���н� Ctrl + V �� �ٿ��ֱ� �Ͻø� �˴ϴ�.";
	
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
